<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Langkah 1-5: Checkout Pembeli & Generate Nomor Pesanan + QRIS
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'ticket_type_id' => 'required',
            'quantity'       => 'nullable|integer|min:1',
            'payment_method' => 'nullable|string'
        ]);

        $ticketTypeId = $request->input('ticket_type_id');
        $ticket = DB::table('ticket_types')->where('id', $ticketTypeId)->orWhere('name', $ticketTypeId)->first();

        if (!$ticket) {
            $ticket = DB::table('ticket_types')->first();
        }

        $quantity    = (int) ($request->input('quantity', 1) ?: 1);
        $totalAmount = $ticket->price * $quantity;

        // Gunakan buyer dari session jika ada, jika tidak buat baru (fallback)
        if ($request->input('buyer_session_id')) {
            $buyerId = $request->input('buyer_session_id');
            $existingBuyer = DB::table('buyers')->where('id', $buyerId)->first();
            if (!$existingBuyer) {
                return response()->json(['success' => false, 'message' => 'Akun pembeli tidak ditemukan.'], 401);
            }
        } else {
            // Fallback: cek dulu apakah email sudah ada
            $name  = $request->input('name', 'Peserta');
            $email = $request->input('email', 'guest@lightandglow.id');
            $existing = DB::table('buyers')->where('email', $email)->first();
            if ($existing) {
                $buyerId = $existing->id;
            } else {
                $buyerId = DB::table('buyers')->insertGetId([
                    'name'       => $name,
                    'email'      => $email,
                    'phone'      => $request->input('phone', '-'),
                    'nik'        => $request->input('nik'),
                    'address'    => $request->input('address', 'Bukittinggi, Sumatera Barat'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Buat Nomor Pesanan Unik (#LG-XXXXX)
        do {
            $randNum     = mt_rand(10000, 99999);
            $orderNumber = "LG-{$randNum}";
            $exists      = DB::table('orders')->where('order_number', $orderNumber)->exists();
        } while ($exists);

        // Payload QRIS Nasional Dinamis
        $qrisPayload = "00020101021226680016ID.CO.QRIS.WWW01189360050300000{$randNum}5204581253033605802ID5914LIGHT%20AND%20GLOW6011BUKITTINGGI630419A8";

        // Kurangi sisa kuota tiket
        if ($ticket->remaining_quota > 0) {
            DB::table('ticket_types')->where('id', $ticket->id)->decrement('remaining_quota', $quantity);
        }

        // Simpan ke Tabel Orders
        $orderId = DB::table('orders')->insertGetId([
            'order_number'   => $orderNumber,
            'buyer_id'       => $buyerId,
            'ticket_type_id' => $ticket->id,
            'quantity'       => $quantity,
            'total_amount'   => $totalAmount,
            'payment_method' => $request->input('payment_method', 'QRIS'),
            'qris_payload'   => $qrisPayload,
            'status'         => 'Menunggu pembayaran',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return response()->json([
            'success'        => true,
            'order_id'       => $orderId,
            'order_number'   => '#' . $orderNumber,
            'total_amount'   => $totalAmount,
            'total_formatted' => 'Rp ' . number_format($totalAmount, 0, ',', '.'),
            'ticket_name'    => $ticket->name,
            'qris_payload'   => $qrisPayload,
            'qris_image_url' => "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode($qrisPayload)
        ]);
    }

    /**
     * Langkah 6-8: Pembeli Unggah Bukti Pembayaran
     */
    public function uploadProof(Request $request, $id)
    {
        $order = DB::table('orders')->where('id', $id)->orWhere('order_number', $id)->orWhere('order_number', ltrim($id, '#'))->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan!'], 404);
        }

        $proofUrl = null;

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = 'proof_' . $order->order_number . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('proofs', $filename, 'public');
            $proofUrl = asset('storage/' . $path);
        } elseif ($request->input('proof_url')) {
            $proofUrl = $request->input('proof_url');
        } else {
            // Default dummy placeholder proof jika di browser simulasi
            $proofUrl = 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=500&auto=format&fit=crop&q=60';
        }

        DB::table('orders')->where('id', $order->id)->update([
            'payment_proof' => $proofUrl,
            'proof_uploaded_at' => now(),
            'status' => 'Menunggu verifikasi',
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bukti pembayaran berhasil diunggah! Status pesanan kini: Menunggu Verifikasi Admin.',
            'order_number' => '#' . $order->order_number,
            'proof_url' => $proofUrl
        ]);
    }

    /**
     * Admin: Setujui Pembayaran & Terbitkan Tiket Digital + QR Code
     */
    public function verifyPayment(Request $request, $id)
    {
        $order = DB::table('orders')
            ->where('id', $id)
            ->orWhere('order_number', $id)
            ->orWhere('order_number', ltrim($id, '#'))
            ->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan!'], 404);
        }

        // 1. Update status pesanan
        DB::table('orders')->where('id', $order->id)->update([
            'status' => 'Pembayaran disetujui',
            'verified_at' => now(),
            'verified_by' => 1,
            'updated_at' => now(),
        ]);

        // 2. Ambil data pembeli
        $buyer = DB::table('buyers')->where('id', $order->buyer_id)->first();

        // 3. Terbitkan Tiket Digital ber-QR Code unik sebanyak quantity
        for ($i = 1; $i <= $order->quantity; $i++) {
            $randomToken = strtoupper(Str::random(8));
            $ticketCode = "LG-BKT-2026-" . mt_rand(10000, 99999);
            $qrToken = "LG-BKT-{$order->id}-{$ticketCode}-" . hash('sha256', Str::random(16) . time());

            DB::table('digital_tickets')->insert([
                'order_id' => $order->id,
                'ticket_type_id' => $order->ticket_type_id,
                'ticket_code' => $ticketCode,
                'qr_token' => $qrToken,
                'holder_name' => $buyer ? $buyer->name : 'Peserta Light & Glow',
                'status' => 'Aktif dan belum digunakan',
                'activated_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran pesanan #' . $order->order_number . ' disetujui. Tiket digital & QR Code resmi telah diterbitkan!',
            'order_number' => '#' . $order->order_number
        ]);
    }

    /**
     * Admin: Tolak Pembayaran Disertai Alasan
     */
    public function rejectPayment(Request $request, $id)
    {
        $order = DB::table('orders')
            ->where('id', $id)
            ->orWhere('order_number', $id)
            ->orWhere('order_number', ltrim($id, '#'))
            ->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan!'], 404);
        }

        $reason = $request->input('reason', 'Bukti mutasi transfer / QRIS tidak valid atau dana belum masuk.');

        // 1. Kembalikan kuota tiket
        DB::table('ticket_types')->where('id', $order->ticket_type_id)->increment('remaining_quota', $order->quantity);

        // 2. Update status order
        DB::table('orders')->where('id', $order->id)->update([
            'status' => 'Pembayaran ditolak',
            'rejection_reason' => $reason,
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan #' . $order->order_number . ' telah ditolak.',
            'order_number' => '#' . $order->order_number,
            'reason' => $reason
        ]);
    }

    /**
     * Petugas: Validasi Scanner QR Code Tiket (Anti-Duplikasi & Audit Log)
     */
    public function validateTicket(Request $request)
    {
        $request->validate([
            'qr_token' => 'required|string'
        ]);

        $tokenInput = trim($request->input('qr_token'));
        $gate = $request->input('gate', 'Gate 1 (Utama Jam Gadang)');
        $staffId = $request->input('staff_id', 2);

        // 1. Cari tiket berdasarkan qr_token atau ticket_code
        $ticket = DB::table('digital_tickets')
            ->join('ticket_types', 'digital_tickets.ticket_type_id', '=', 'ticket_types.id')
            ->join('orders', 'digital_tickets.order_id', '=', 'orders.id')
            ->select('digital_tickets.*', 'ticket_types.name as ticket_name', 'ticket_types.category as ticket_category', 'orders.order_number', 'orders.status as order_status')
            ->where('digital_tickets.qr_token', $tokenInput)
            ->orWhere('digital_tickets.ticket_code', $tokenInput)
            ->first();

        // Kasus 1: Tiket Tidak Ditemukan / Tidak Valid
        if (!$ticket) {
            DB::table('check_in_logs')->insert([
                'digital_ticket_id' => 1,
                'event_id' => 1,
                'staff_id' => $staffId,
                'gate_location' => $gate,
                'validation_status' => 'rejected_invalid',
                'notes' => 'QR Code atau nomor tiket palsu/tidak terdaftar: ' . $tokenInput,
                'ip_address' => $request->ip(),
                'scanned_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => false,
                'status' => 'rejected_invalid',
                'title' => 'Tiket Tidak Valid!',
                'message' => 'QR Code atau nomor tiket tidak ditemukan di sistem database resmi Light and Glow Bukittinggi.'
            ], 400);
        }

        // Kasus 2: Tiket Sudah Pernah Digunakan (Anti Double Check-in)
        if ($ticket->status === 'Sudah digunakan') {
            DB::table('check_in_logs')->insert([
                'digital_ticket_id' => $ticket->id,
                'event_id' => 1,
                'staff_id' => $staffId,
                'gate_location' => $gate,
                'validation_status' => 'rejected_used',
                'notes' => "Peringatan duplikasi: Tiket {$ticket->ticket_code} sudah pernah digunakan pada " . ($ticket->used_at ?: 'sebelumnya'),
                'ip_address' => $request->ip(),
                'scanned_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => false,
                'status' => 'rejected_used',
                'title' => 'Tiket Sudah Digunakan!',
                'message' => "PERINGATAN: Tiket atas nama {$ticket->holder_name} ({$ticket->ticket_code}) sudah dipakai check-in sebelumnya pada {$ticket->used_at}!",
                'ticket' => $ticket
            ], 409);
        }

        // Kasus 3: Status Pembayaran Belum Disetujui
        if ($ticket->order_status !== 'Pembayaran disetujui') {
            return response()->json([
                'success' => false,
                'status' => 'rejected_invalid',
                'title' => 'Pembayaran Belum Disetujui!',
                'message' => "Tiket ini belum aktif karena pembayaran pesanan #{$ticket->order_number} belum disetujui oleh admin."
            ], 400);
        }

        // Kasus 4: Tiket Valid & Sukses Masuk
        DB::table('digital_tickets')->where('id', $ticket->id)->update([
            'status' => 'Sudah digunakan',
            'used_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('check_in_logs')->insert([
            'digital_ticket_id' => $ticket->id,
            'event_id' => 1,
            'staff_id' => $staffId,
            'gate_location' => $gate,
            'validation_status' => 'success',
            'notes' => "Check-in Berhasil. Race pack & neon wristband diserahkan kepada {$ticket->holder_name}.",
            'ip_address' => $request->ip(),
            'scanned_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'status' => 'success',
            'title' => 'Check-in Berhasil Disetujui! ✅',
            'message' => "Selamat datang, {$ticket->holder_name}! Silakan masuk melalui {$gate}.",
            'ticket' => [
                'holder_name' => $ticket->holder_name,
                'ticket_code' => $ticket->ticket_code,
                'ticket_name' => $ticket->ticket_name,
                'ticket_category' => $ticket->ticket_category,
                'gate' => $gate,
                'time' => now()->format('H:i:s WIB')
            ]
        ]);
    }
}
