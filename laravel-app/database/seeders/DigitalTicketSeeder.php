<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DigitalTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('digital_tickets')->insert([
            [
                'id' => 1,
                'order_id' => 4, // Siti Aisyah (Disetujui)
                'ticket_type_id' => 3,
                'ticket_code' => 'LG-BKT-2026-77821',
                'qr_token' => 'LG-BKT-2026-77821-SECURE-TOKEN-A',
                'holder_name' => 'Siti Aisyah',
                'status' => 'Sudah digunakan',
                'activated_at' => now()->subHours(2),
                'used_at' => now()->subMinutes(30),
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subMinutes(30),
            ],
            [
                'id' => 2,
                'order_id' => 4, // Siti Aisyah Tiket ke-2
                'ticket_type_id' => 3,
                'ticket_code' => 'LG-BKT-2026-77822',
                'qr_token' => 'LG-BKT-2026-77822-SECURE-TOKEN-B',
                'holder_name' => 'Doni Pratama',
                'status' => 'Aktif dan belum digunakan',
                'activated_at' => now()->subHours(2),
                'used_at' => null,
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'id' => 3,
                'order_id' => 1, // Simulasi tiket VIP aktif
                'ticket_type_id' => 2,
                'ticket_code' => 'LG-BKT-2026-99214',
                'qr_token' => 'LG-BKT-2026-99214-SECURE-TOKEN-C',
                'holder_name' => 'Rian Hidayat',
                'status' => 'Aktif dan belum digunakan',
                'activated_at' => now()->subMinutes(10),
                'used_at' => null,
                'created_at' => now()->subMinutes(10),
                'updated_at' => now()->subMinutes(10),
            ],
        ]);
    }
}
