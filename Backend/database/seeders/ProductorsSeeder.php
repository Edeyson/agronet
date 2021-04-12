<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productors')->insert([
           'direccion'=>" la casa verde",
           'user_id'=>2,

        ]);

        DB::table('productors')->insert([
            'direccion'=>" la casa roja",
            'user_id'=>3, 
        ]);
    }
}
