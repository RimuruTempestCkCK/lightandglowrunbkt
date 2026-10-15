<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buyers')->insert([
            [
                'id' => 1,
                'name' => 'Rian Hidayat',
                'email' => 'rian.h@gmail.com',
                'phone' => '081267891234',
                'nik' => '1375012304950001',
                'address' => 'Guguk Panjang, Bukittinggi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Nadia Putri',
                'email' => 'nadia.putri@gmail.com',
                'phone' => '082188776655',
                'nik' => '1375021208980002',
                'address' => 'Mandiangin Koto Selayan, Bukittinggi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Budi Setiawan',
                'email' => 'budi.setiawan@gmail.com',
                'phone' => '085277889900',
                'nik' => '1371050501920003',
                'address' => 'Padang Barat, Kota Padang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Siti Aisyah',
                'email' => 'siti.aisyah@yahoo.com',
                'phone' => '082199887766',
                'nik' => '1375031405990004',
                'address' => 'Aur Birugo Tigo Baleh, Bukittinggi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Ahmad Fauzan',
                'email' => 'fauzan@gmail.com',
                'phone' => '081399001122',
                'nik' => '1371011010960005',
                'address' => 'Payakumbuh Barat, Payakumbuh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
