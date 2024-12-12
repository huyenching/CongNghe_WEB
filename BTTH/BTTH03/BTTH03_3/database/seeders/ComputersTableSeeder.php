<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
        DB::table('computers')->insert([
        'computer_name' => $faker->unique()->word . '-' . $faker->randomNumber(2),
                'model' => $faker->company . ' ' . $faker->word,
                'operating_system' => $faker->randomElement(['Windows 10 Pro', 'Windows 11', 'Ubuntu 22.04', 'macOS Ventura']),
                'processor' => $faker->randomElement(['Intel Core i5-11400', 'Intel Core i7-12700', 'AMD Ryzen 5 5600X', 'Apple M1']),
                'memory' => $faker->randomElement([8, 16, 32, 64]),
                'available' => $faker->boolean,
        ]);
        }
    }

}