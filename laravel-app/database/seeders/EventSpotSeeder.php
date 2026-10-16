<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spots = [
            [
                'id' => 1,
                'name' => 'Jam Gadang',
                'description' => 'Start & Finish / Main Stage',
                'image' => '/uploads/spots/spot_1792164029_aNM4K9aN.jpg',
                'order_index' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Ngarai Sianok',
                'description' => 'Panorama Viewpoint & Photobooth',
                'image' => '/uploads/spots/spot_1792164037_daSig7Hy.jpg',
                'order_index' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Fort de Kock',
                'description' => 'Neon Light Tunnel Zone',
                'image' => '/uploads/spots/spot_1792164045_iFGPms0B.webp',
                'order_index' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Jembatan Limpapeh',
                'description' => 'Cheering Station & DJ Booth',
                'image' => '/uploads/spots/spot_1792164055_1rxm6CeE.jpg',
                'order_index' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Pelataran Pasar Atas',
                'description' => 'Glow Festival Food & Bazaar',
                'image' => '/uploads/spots/spot_1792164064_OnkRQ78t.jpg',
                'order_index' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($spots as $s) {
            DB::table('event_spots')->updateOrInsert(
                ['id' => $s['id']],
                $s
            );
        }
    }
}
