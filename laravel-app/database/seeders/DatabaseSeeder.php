<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EventSeeder::class,
            TicketTypeSeeder::class,
            BuyerSeeder::class,
            OrderSeeder::class,
            DigitalTicketSeeder::class,
            CheckInLogSeeder::class,
            BannerSeeder::class,
        ]);
    }
}
