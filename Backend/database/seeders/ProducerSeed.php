<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProducerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('producers')->insert([
            'registered_user_id'=>2,
        ]);

        DB::table('producers')->insert([
            'registered_user_id'=>3,
        ]);
    }
}
