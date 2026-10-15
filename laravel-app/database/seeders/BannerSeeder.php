<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banners')->insert([
            [
                'id' => 1,
                'tag' => 'NIGHT RUN & CONCERT',
                'title' => 'Light And Glow Bukittinggi 2026',
                'description' => 'Sensasi lari malam 5K bertabur cahaya neon glow-in-the-dark dan konser spektakuler di Jam Gadang Bukittinggi.',
                'image' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=1200&auto=format&fit=crop',
                'order_index' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'tag' => 'SPECIAL GUEST STARS',
                'title' => 'Deretan DJ & Artis Ternama',
                'description' => 'Panggung musik megah dengan tata cahaya laser visual memukau menemani pesta neon sampai malam.',
                'image' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=1200&auto=format&fit=crop',
                'order_index' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'tag' => 'LIMITED EARLY BIRD',
                'title' => 'Dapatkan Tiket Spesial Kamu!',
                'description' => 'Termasuk Glow Pack eksklusif (Neon Tee, LED Glasses, Glow Stick, Medal Finisher & Refreshment).',
                'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=1200&auto=format&fit=crop',
                'order_index' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
