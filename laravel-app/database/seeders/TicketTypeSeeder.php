<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = [
            [
                'id' => 1,
                'event_id' => 1,
                'name' => 'Early Bird - Festival Pass',
                'category' => 'Festival Run',
                'price' => 99000,
                'quota' => 200,
                'remaining_quota' => 12,
                'benefits' => 'Nomor Dada (BIB), Neon Wristband, Glow Stick, Finisher Medal & Mineral Water',
                'image' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=500&auto=format&fit=crop&q=60',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'event_id' => 1,
                'name' => 'Presale - VIP Glow Run',
                'category' => 'VIP Access',
                'price' => 275000,
                'quota' => 150,
                'remaining_quota' => 45,
                'benefits' => 'Akses Barisan Depan Panggung, Glow Tee Eksklusif, LED Glasses, VIP Lounge, Refreshment & Finisher Medal',
                'image' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=500&auto=format&fit=crop&q=60',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'event_id' => 1,
                'name' => 'Reguler - 5K Night Run',
                'category' => 'Reguler Run',
                'price' => 150000,
                'quota' => 300,
                'remaining_quota' => 180,
                'benefits' => 'Jersey Night Run, BIB Number, Glow Pack, Refreshment & Medali Finisher Logam',
                'image' => 'https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?w=500&auto=format&fit=crop&q=60',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'event_id' => 1,
                'name' => 'Squad / Group Bundle (4 Pax)',
                'category' => 'Group Bundle',
                'price' => 500000,
                'quota' => 50,
                'remaining_quota' => 24,
                'benefits' => 'Paket Hemat untuk 4 Pelari, 4x Jersey, 4x BIB, 4x Paket Glow Neon & 4x Medali Finisher',
                'image' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&auto=format&fit=crop&q=60',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($tickets as $t) {
            DB::table('ticket_types')->updateOrInsert(
                ['id' => $t['id']],
                $t
            );
        }
    }
}
