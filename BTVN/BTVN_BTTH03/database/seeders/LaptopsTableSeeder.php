<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class LaptopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('books')->insert([
          'brand' => $faker->company,
                'model' => $faker->word,
                'specifications' => $faker->sentence,
                'rental_status' => $faker->boolean,
                'renter_id' => $faker->numberBetween(1, 10), 
           
   ]);

    }
    }
}
