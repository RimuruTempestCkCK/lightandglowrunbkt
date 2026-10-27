<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->updateOrInsert(
            ['id' => 1],
            [
                'title' => 'Light And Glow Bukittinggi 2026',
                'slug' => 'light-and-glow-bukittinggi-2026',
                'description' => 'Sensasi lari malam 5K bertabur cahaya neon glow-in-the-dark dan konser spektakuler di Jam Gadang Bukittinggi.',
                'location' => 'Jam Gadang, Bukittinggi, Sumatera Barat',
                'event_date' => '2026-04-25',
                'start_time' => '17:00:00',
                'end_time' => '23:30:00',
                'banner_image' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=1200&auto=format&fit=crop',
                'qris_image' => '/uploads/qris/qris_1792143189_UJtd1dba.jpeg',
                'qris_merchant_name' => 'LIGHT AND GLOW BUKITTINGGI',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
