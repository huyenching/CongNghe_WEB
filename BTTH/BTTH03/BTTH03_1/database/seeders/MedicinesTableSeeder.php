<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('books')->insert([
           'name'=> $faker->name,
           'brand'=> $faker->company,
           'dosage'=> $faker->word,
           'form'=> $faker->word,
           'price'=> $faker->randomFloat(2,1,500),
           'stock'=> $faker->numberBetween(1,100),
           
           
   ]);

    }
    }
}
