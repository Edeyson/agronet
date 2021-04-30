<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            ProducerSeed::class,
            AdminsSeeder::class,
            AddrSeeder::class,
            GeoSeeder::class,
            EventSeeder::class
        ]);
    }
}
