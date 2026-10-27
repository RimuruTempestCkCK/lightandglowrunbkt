<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $quantity = (int) ($request->input('quantity', 1) ?: 1);

        // Validasi kuota tiket
        if ($ticket->remaining_quota <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, kuota tiket "' . $ticket->name . '" sudah habis terjual!'
            ], 422);
        }

        if ($ticket->remaining_quota < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Sisa kuota tiket hanya tersisa ' . $ticket->remaining_quota . ' tiket.'
            ], 422);
        }

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

        // Simpan ke Tabel Orders (Kuota TIDAK berkurang saat checkout, hanya berkurang setelah admin menyetujui pembayaran)
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

        // Cek apakah Admin sudah mengunggah / mengonfigurasi Foto QRIS di Master Acara
        $eventData = DB::table('events')->first();
        if ($eventData && !empty($eventData->qris_image)) {
            $rawImg = $eventData->qris_image;
            $qrisImageUrl = Str::startsWith($rawImg, ['http://', 'https://']) ? $rawImg : asset(ltrim($rawImg, '/'));
        } else {
            $qrisImageUrl = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode($qrisPayload);
        }

        return response()->json([
            'success'        => true,
            'order_id'       => $orderId,
            'order_number'   => '#' . $orderNumber,
            'total_amount'   => $totalAmount,
            'total_formatted' => 'Rp ' . number_format($totalAmount, 0, ',', '.'),
            'ticket_name'    => $ticket->name,
            'qris_payload'   => $qrisPayload,
            'qris_image_url' => $qrisImageUrl,
            'qris_merchant'  => $eventData->qris_merchant_name ?? 'LIGHT AND GLOW BUKITTINGGI'
        ]);
    }

    /**
     * Langkah 6-8: Pembeli Unggah Bukti Pembayaran
     */
    public function uploadProof(Request $request, $id)
    {
        // 1. Validasi Input Berkas (Keamanan Tipe & Ukuran Maksimal 5MB)
        $request->validate([
            'payment_proof' => 'nullable|file|image|mimes:jpeg,png,jpg,webp|max:5120',
            'proof_url'     => 'nullable|string|max:500'
        ], [
            'payment_proof.image' => 'Berkas bukti pembayaran harus berupa gambar.',
            'payment_proof.mimes' => 'Format gambar yang diperbolehkan hanya JPG, JPEG, PNG, atau WEBP.',
            'payment_proof.max'   => 'Ukuran berkas bukti pembayaran maksimal adalah 5MB.'
        ]);

        // 2. Otorisasi Pembeli: Wajib login sebagai pembeli
        $buyer = session('buyer');
        if (!$buyer || empty($buyer['id'])) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu sebagai pembeli untuk mengunggah bukti pembayaran.'
            ], 401);
        }

        $order = DB::table('orders')->where('id', $id)->orWhere('order_number', $id)->orWhere('order_number', ltrim($id, '#'))->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan!'], 404);
        }

        // 3. Validasi Kepemilikan: Tolak jika pesanan bukan milik pembeli yang sedang login (IDOR Protection)
        if ($order->buyer_id != $buyer['id']) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak: Anda tidak memiliki hak akses untuk mengunggah bukti pada pesanan ini.'
            ], 403);
        }

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $extension = strtolower($file->getClientOriginalExtension());
            $safeExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            if (!in_array($extension, $safeExtensions)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ekstensi file tidak aman atau tidak didukung.'
                ], 422);
            }
            $filename = 'proof_' . $order->order_number . '_' . time() . '.' . $extension;
            $path = $file->storeAs('proofs', $filename, 'public');
            // Simpan relative path 'storage/proofs/...' agar fleksibel di localhost maupun Ngrok/Dev Tunnel
            $proofUrl = 'storage/' . $path;
        } elseif ($request->input('proof_url')) {
            $proofUrl = $request->input('proof_url');
        } else {
            return response()->json([
                'success' => false,
                'message' => 'File bukti pembayaran wajib diunggah!'
            ], 422);
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
            'proof_url' => asset($proofUrl)
        ]);
    }

    /**
     * Admin: Setujui Pembayaran & Terbitkan Tiket Digital + QR Code
     */
    public function verifyPayment(Request $request, $id)
    {
        // 1. Otorisasi Server-side: Hanya administrator yang berwenang (User ID 1) yang diizinkan menyetujui pembayaran
        if (!Auth::check() || Auth::id() != 1) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Anda harus login sebagai Administrator untuk menyetujui pembayaran.'
            ], 403);
        }

        return DB::transaction(function () use ($request, $id) {
            $order = DB::table('orders')
                ->where('id', $id)
                ->orWhere('order_number', $id)
                ->orWhere('order_number', ltrim($id, '#'))
                ->lockForUpdate()
                ->first();

            if (!$order) {
                return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan!'], 404);
            }

            // 2. Cegah verifikasi ganda / penerbitan tiket ganda (Idempotensi)
            if ($order->status === 'Pembayaran disetujui') {
                return response()->json([
                    'success' => true,
                    'message' => 'Pembayaran pesanan #' . $order->order_number . ' sebelumnya sudah disetujui.',
                    'order_number' => '#' . $order->order_number
                ]);
            }

            // 3. Validasi Bukti Pembayaran: Bukti transfer tidak boleh kosong
            if (empty($order->payment_proof) || trim($order->payment_proof) === '') {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memverifikasi: Pesanan #' . $order->order_number . ' belum mengunggah bukti pembayaran QRIS / transfer.'
                ], 422);
            }

            // 4. Validasi Status Pesanan: Hanya pesanan berstatus 'Menunggu verifikasi' yang dapat disetujui
            if ($order->status !== 'Menunggu verifikasi') {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memverifikasi: Status pesanan saat ini adalah "' . $order->status . '". Hanya pesanan berstatus "Menunggu verifikasi" yang dapat disetujui.'
                ], 422);
            }

            // 5. Kunci baris tiket_types untuk pengecekan dan pengurangan kuota yang aman dari race condition
            $ticketType = DB::table('ticket_types')->where('id', $order->ticket_type_id)->lockForUpdate()->first();
            if (!$ticketType) {
                return response()->json(['success' => false, 'message' => 'Kategori tiket untuk pesanan ini tidak ditemukan!'], 404);
            }

            // 6. Periksa ketersediaan kuota aktual
            if ($ticketType->remaining_quota < $order->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyetujui pembayaran: Sisa kuota tiket "' . $ticketType->name . '" tidak mencukupi (sisa: ' . $ticketType->remaining_quota . ', dibutuhkan: ' . $order->quantity . ').'
                ], 422);
            }

            // 7. Kurangi kuota tiket tepat satu kali saat admin menyetujui pembayaran
            DB::table('ticket_types')->where('id', $ticketType->id)->decrement('remaining_quota', $order->quantity);

            // 8. Update status pesanan menjadi 'Pembayaran disetujui'
            DB::table('orders')->where('id', $order->id)->update([
                'status' => 'Pembayaran disetujui',
                'verified_at' => now(),
                'verified_by' => Auth::id() ?: 1,
                'updated_at' => now(),
            ]);

            // 9. Ambil data pembeli
            $buyer = DB::table('buyers')->where('id', $order->buyer_id)->first();

            // 10. Terbitkan tiket digital tepat satu kali jika belum pernah diterbitkan
            $existingTicketsCount = DB::table('digital_tickets')->where('order_id', $order->id)->count();
            if ($existingTicketsCount < $order->quantity) {
                $needed = $order->quantity - $existingTicketsCount;
                for ($i = 1; $i <= $needed; $i++) {
                    $ticketCode = "LG-BKT-2026-" . mt_rand(10000, 99999);
                    $qrToken = "LG-BKT-{$order->id}-{$ticketCode}-" . hash('sha256', Str::random(16) . microtime(true) . $i);

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
            }

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran pesanan #' . $order->order_number . ' disetujui. Kuota tiket berhasil dikurangi dan tiket digital resmi telah diterbitkan!',
                'order_number' => '#' . $order->order_number
            ]);
        });
    }

    /**
     * Admin: Tolak Pembayaran Disertai Alasan
     */
    public function rejectPayment(Request $request, $id)
    {
        // 1. Otorisasi Server-side: Hanya administrator yang berwenang (User ID 1) yang diizinkan menolak pembayaran
        if (!Auth::check() || Auth::id() != 1) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Anda harus login sebagai Administrator untuk menolak pembayaran.'
            ], 403);
        }

        return DB::transaction(function () use ($request, $id) {
            $order = DB::table('orders')
                ->where('id', $id)
                ->orWhere('order_number', $id)
                ->orWhere('order_number', ltrim($id, '#'))
                ->lockForUpdate()
                ->first();

            if (!$order) {
                return response()->json(['success' => false, 'message' => 'Pesanan tidak ditemukan!'], 404);
            }

            // Cegah penolakan terhadap pesanan yang sudah berstatus disetujui / lunas demi konsistensi data
            if ($order->status === 'Pembayaran disetujui') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pesanan #' . $order->order_number . ' sudah berstatus disetujui / lunas dan tiket digital telah terbit. Tidak dapat ditolak secara langsung.'
                ], 422);
            }

            // Cegah penolakan berulang
            if ($order->status === 'Pembayaran ditolak') {
                return response()->json([
                    'success' => true,
                    'message' => 'Pesanan #' . $order->order_number . ' sebelumnya sudah ditolak.',
                    'order_number' => '#' . $order->order_number
                ]);
            }

            $reason = $request->input('reason', 'Bukti mutasi transfer / QRIS tidak valid atau dana belum masuk.');

            // Update status pesanan menjadi 'Pembayaran ditolak' (Tidak menambah kuota karena kuota tidak dikurangi saat checkout)
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
        });
    }

    /**
     * Petugas: Validasi Scanner QR Code Tiket (Anti-Duplikasi & Audit Log)
     */
    public function validateTicket(Request $request)
    {
        $request->validate([
            'qr_token' => 'required|string'
        ]);

        // 1. Otorisasi Petugas / Admin: Wajib terautentikasi di sesi internal
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'status' => 'unauthorized',
                'title' => 'Akses Ditolak!',
                'message' => 'Akses ditolak. Sesi petugas tidak valid. Silakan login terlebih dahulu.'
            ], 401);
        }

        $tokenInput = trim($request->input('qr_token'));
        $gate = $request->input('gate', 'Gate 1 (Utama Jam Gadang)');
        $staffId = Auth::id();

        return DB::transaction(function () use ($request, $tokenInput, $gate, $staffId) {
            // 1. Cari tiket berdasarkan qr_token atau ticket_code dengan lock
            $ticket = DB::table('digital_tickets')
                ->join('ticket_types', 'digital_tickets.ticket_type_id', '=', 'ticket_types.id')
                ->join('orders', 'digital_tickets.order_id', '=', 'orders.id')
                ->select('digital_tickets.*', 'ticket_types.name as ticket_name', 'ticket_types.category as ticket_category', 'orders.order_number', 'orders.status as order_status')
                ->where('digital_tickets.qr_token', $tokenInput)
                ->orWhere('digital_tickets.ticket_code', $tokenInput)
                ->lockForUpdate()
                ->first();

            // Kasus 1: Tiket Tidak Ditemukan / Tidak Valid
            if (!$ticket) {
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
                    'data' => [
                        'attendee_name' => $ticket->holder_name,
                        'ticket_code' => $ticket->ticket_code,
                        'used_at' => $ticket->used_at ? \Carbon\Carbon::parse($ticket->used_at)->format('d M Y, H:i') : 'Sebelumnya'
                    ]
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
                'status' => 'valid',
                'title' => 'Check-in Berhasil Disetujui! ✅',
                'message' => "Selamat datang, {$ticket->holder_name}! Silakan masuk melalui {$gate}.",
                'data' => [
                    'attendee_name' => $ticket->holder_name,
                    'ticket_code' => $ticket->ticket_code,
                    'ticket_name' => $ticket->ticket_name,
                    'ticket_category' => $ticket->ticket_category,
                    'order_number' => '#' . $ticket->order_number,
                    'gate' => $gate,
                    'time' => now()->format('H:i:s WIB')
                ]
            ]);
        });
    }
}
