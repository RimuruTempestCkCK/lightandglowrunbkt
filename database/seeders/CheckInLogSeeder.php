<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckInLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('check_in_logs')->insert([
            [
                'id' => 1,
                'digital_ticket_id' => 1,
                'event_id' => 1,
                'staff_id' => 2, // Alex Gate 1
                'gate_location' => 'Gate 1 (Utama)',
                'validation_status' => 'success',
                'notes' => 'Peserta masuk pertama kali, wristband dan neon pack diserahkan.',
                'ip_address' => '192.168.1.101',
                'scanned_at' => now()->subMinutes(30),
                'created_at' => now()->subMinutes(30),
                'updated_at' => now()->subMinutes(30),
            ],
            [
                'id' => 2,
                'digital_ticket_id' => 1,
                'event_id' => 1,
                'staff_id' => 3, // Bunga Gate 2
                'gate_location' => 'Gate 2 (VIP Pass)',
                'validation_status' => 'rejected_used',
                'notes' => 'Peringatan: Tiket sudah digunakan 5 menit lalu di Gate 1.',
                'ip_address' => '192.168.1.102',
                'scanned_at' => now()->subMinutes(25),
                'created_at' => now()->subMinutes(25),
                'updated_at' => now()->subMinutes(25),
            ],
        ]);
    }
}
