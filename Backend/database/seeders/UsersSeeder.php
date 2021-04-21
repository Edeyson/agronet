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

         for($i=0; $i<5; $i++){
            DB::table('registered_users')->insert([
                  'nombre'=> $faker->firstName(),
                  'apellido'=>$faker->lastName(),
                  'email'=>$faker->email(),
                  'password'=> Hash::make('hola123'),
                  'departamento'=>$faker->state(),
                  'ciudad'=>$faker->city(),
                  'telefono'=>$faker->phoneNumber(),
            ]);
        }
    }
}
