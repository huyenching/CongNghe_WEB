<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CinemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('cinemas')->insert([
           'name'=> $faker->sentence(4),
           'location'=> $faker->address,
           'total_seats'=> $faker->numberBetween(20,100),
          
           
   ]);

    }
    }
}
