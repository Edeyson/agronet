<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //pte registrar geo
        //geo { lt:5.068089598694797, lng:-75.51734696649181 }
        DB::table('addrs')->insert([
            'registered_user_id'=>2,
            'country'=>'Colombia',
            'province'=>'caldas',
            'city'=>'Manizales',
            'street'=>'Cr 22 Cl 22',
            'location'=>'Plaza Bolivar',
            'etiqueta'=>'Plaza Bolivar'
        ]);

        //pte registrar geo
        //geo { lt:5.069790527364546, lng:-75.51875261140086 }
        DB::table('addrs')->insert([
            'registered_user_id'=>2,
            'country'=>'Colombia',
            'province'=>'caldas',
            'city'=>'Manizales',
            'street'=>'Cr 19 Cl 21',
            'location'=>'Plaza Alfonso López',
            'etiqueta'=>'Plaza Alfonso López'
        ]);

        //pte registrar geo
        //geo { lt:5.067615140686897, lng:-75.51274565352365 }
        DB::table('addrs')->insert([
            'registered_user_id'=>2,
            'country'=>'Colombia',
            'province'=>'caldas',
            'city'=>'Manizales',
            'street'=>'Cr 22 Cl 30',
            'location'=>'Parque Caldas',
            'etiqueta'=>'Parque Caldas'
        ]);

        //pte registrar geo
        //geo { lt:5.068293912359735, lng:-75.5122080500452 }
        DB::table('addrs')->insert([
            'registered_user_id'=>2,
            'country'=>'Colombia',
            'province'=>'caldas',
            'city'=>'Manizales',
            'street'=>'Cr 21 Cl 30',
            'location'=>'Parque Ernesto Gutiérrez',
            'etiqueta'=>'Parque Ernesto Gutiérrez'
        ]);

        //pte registrar geo
        //geo { lt:5.067701374425539, lng:-75.51069474949153 }
        DB::table('addrs')->insert([
            'registered_user_id'=>3,
            'country'=>'Colombia',
            'province'=>'caldas',
            'city'=>'Manizales',
            'street'=>'Cr 23 Cl 32',
            'location'=>'Parque Fundadores',
            'etiqueta'=>'Monumento Fundadores'
        ]);

        //pte registrar geo
        //geo { lt:5.065263429967828, lng:-75.49921421417056 }
        DB::table('addrs')->insert([
            'registered_user_id'=>3,
            'country'=>'Colombia',
            'province'=>'caldas',
            'city'=>'Manizales',
            'street'=>'Cr 23 Cl 48',
            'location'=>'Parque De La Mujer',
            'etiqueta'=>'Parque De La Mujer'
        ]);

         //pte registrar geo
        //geo { lt:5.048761667038207, lng:-75.476811261513 }
        DB::table('addrs')->insert([
            'registered_user_id'=>3,
            'country'=>'Colombia',
            'province'=>'caldas',
            'city'=>'Manizales',
            'street'=>'Cr 23 Transversal 72',
            'location'=>'Mirador Niza',
            'etiqueta'=>'Mirador Niza'
        ]);
    }
}
