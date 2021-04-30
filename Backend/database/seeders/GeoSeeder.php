<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('geo_locations')->insert([
            'latitud'=>5.068089598694797,
            'longitud'=>-75.51734696649181,
            'addr_id'=>1            
        ]);
        DB::table('geo_locations')->insert([
            'latitud'=>5.069790527364546,
            'longitud'=>-75.51875261140086,
            'addr_id'=>2            
        ]);
        DB::table('geo_locations')->insert([
            'latitud'=>5.067615140686897,
            'longitud'=>-75.51274565352365,
            'addr_id'=>3            
        ]);
        DB::table('geo_locations')->insert([
            'latitud'=>5.068293912359735,
            'longitud'=>-75.5122080500452,
            'addr_id'=>4            
        ]);
        DB::table('geo_locations')->insert([
            'latitud'=>5.067701374425539,
            'longitud'=>-75.51069474949153,
            'addr_id'=>5            
        ]);
        DB::table('geo_locations')->insert([
            'latitud'=>5.065263429967828,
            'longitud'=>-75.49921421417056,
            'addr_id'=>6            
        ]);
        DB::table('geo_locations')->insert([
            'latitud'=>5.048761667038207,
            'longitud'=>-75.476811261513,
            'addr_id'=>7            
        ]);
    }
}
