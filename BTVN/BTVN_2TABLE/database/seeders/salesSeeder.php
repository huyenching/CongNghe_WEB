<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class salesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
            DB::table('sales')->insert([
            'medicine_id' => $faker->numberBetween(1, 10),
            'quantity' => $faker->numberBetween(1, 5),
            'sale_date' => $faker->dateTimeThisYear(),
            'customer_phone' =>
            $faker->optional(0.7)->numerify('09########'), // 70% có số điện thoại
            'created_at' => now(),
            'updated_at' => now(),
            ]);
        }
    }
}
