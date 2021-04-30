<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();


        DB::table('registered_users')->insert([
                'nombre'=> 'Admin',
                'apellido'=>'Super Admin',
                'email'=>'admin@mail.es',
                'password'=> Hash::make('hola123'),
                'departamento'=>$faker->state(),
                'ciudad'=>$faker->city(),
                'telefono'=>$faker->phoneNumber(),
        ]);

        DB::table('registered_users')->insert([
            'nombre'=> 'Producer',
            'apellido'=>'01',
            'email'=>'producer01@mail.es',
            'password'=> Hash::make('hola123'),
            'departamento'=>$faker->state(),
            'ciudad'=>$faker->city(),
            'telefono'=>$faker->phoneNumber(),
        ]);

        DB::table('registered_users')->insert([
            'nombre'=> 'Producer',
            'apellido'=>'02',
            'email'=>'producer02@mail.es',
            'password'=> Hash::make('hola123'),
            'departamento'=>$faker->state(),
            'ciudad'=>$faker->city(),
            'telefono'=>$faker->phoneNumber(),
        ]);

        DB::table('registered_users')->insert([
            'nombre'=> 'user',
            'apellido'=>'01',
            'email'=>'user01@mail.es',
            'password'=> Hash::make('hola123'),
            'departamento'=>$faker->state(),
            'ciudad'=>$faker->city(),
            'telefono'=>$faker->phoneNumber(),
    ]);

    }
}
