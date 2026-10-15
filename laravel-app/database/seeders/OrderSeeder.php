<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'id' => 1,
                'order_number' => 'LG-88421',
                'buyer_id' => 1, // Rian Hidayat
                'ticket_type_id' => 2, // VIP Glow Run
                'quantity' => 1,
                'total_amount' => 275000,
                'payment_method' => 'QRIS BCA',
                'qris_payload' => '00020101021226680016ID.CO.QRIS.WWW01189360050300000884215204581253033605802ID5914LIGHT%20AND%20GLOW6011BUKITTINGGI630419A8',
                'payment_proof' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=500&auto=format&fit=crop&q=60',
                'proof_uploaded_at' => now()->subMinutes(15),
                'status' => 'Menunggu verifikasi',
                'rejection_reason' => null,
                'verified_at' => null,
                'verified_by' => null,
                'created_at' => now()->subMinutes(20),
                'updated_at' => now()->subMinutes(15),
            ],
            [
                'id' => 2,
                'order_number' => 'LG-88420',
                'buyer_id' => 2, // Nadia Putri
                'ticket_type_id' => 3, // Reguler 5K Night Run
                'quantity' => 1,
                'total_amount' => 150000,
                'payment_method' => 'Transfer Mandiri',
                'qris_payload' => null,
                'payment_proof' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=500&auto=format&fit=crop&q=60',
                'proof_uploaded_at' => now()->subMinutes(40),
                'status' => 'Menunggu verifikasi',
                'rejection_reason' => null,
                'verified_at' => null,
                'verified_by' => null,
                'created_at' => now()->subMinutes(45),
                'updated_at' => now()->subMinutes(40),
            ],
            [
                'id' => 3,
                'order_number' => 'LG-88419',
                'buyer_id' => 3, // Budi Setiawan
                'ticket_type_id' => 1, // Early Bird Pass
                'quantity' => 1,
                'total_amount' => 99000,
                'payment_method' => 'QRIS GoPay',
                'qris_payload' => '00020101021226680016ID.CO.QRIS.WWW01189360050300000884195204581253033605802ID5914LIGHT%20AND%20GLOW6011BUKITTINGGI630419A8',
                'payment_proof' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=500&auto=format&fit=crop&q=60',
                'proof_uploaded_at' => now()->subHours(1),
                'status' => 'Menunggu verifikasi',
                'rejection_reason' => null,
                'verified_at' => null,
                'verified_by' => null,
                'created_at' => now()->subHours(1)->subMinutes(10),
                'updated_at' => now()->subHours(1),
            ],
            [
                'id' => 4,
                'order_number' => 'LG-88415',
                'buyer_id' => 4, // Siti Aisyah
                'ticket_type_id' => 3, // Reguler 5K
                'quantity' => 2,
                'total_amount' => 300000,
                'payment_method' => 'Transfer Mandiri',
                'qris_payload' => null,
                'payment_proof' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=500&auto=format&fit=crop&q=60',
                'proof_uploaded_at' => now()->subHours(3),
                'status' => 'Pembayaran disetujui',
                'rejection_reason' => null,
                'verified_at' => now()->subHours(2)->subMinutes(50),
                'verified_by' => 1, // Admin
                'created_at' => now()->subHours(3)->subMinutes(15),
                'updated_at' => now()->subHours(2)->subMinutes(50),
            ],
            [
                'id' => 5,
                'order_number' => 'LG-88402',
                'buyer_id' => 5, // Ahmad Fauzan
                'ticket_type_id' => 4, // Squad Bundle
                'quantity' => 1,
                'total_amount' => 500000,
                'payment_method' => 'Transfer BCA',
                'qris_payload' => null,
                'payment_proof' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=500&auto=format&fit=crop&q=60',
                'proof_uploaded_at' => now()->subDay(),
                'status' => 'Pembayaran ditolak',
                'rejection_reason' => 'Bukti transfer tidak sesuai dengan nominal total pemesanan tiket.',
                'verified_at' => now()->subDay()->addHours(1),
                'verified_by' => 1,
                'created_at' => now()->subDay()->subHours(1),
                'updated_at' => now()->subDay()->addHours(1),
            ],
        ]);
    }
}
