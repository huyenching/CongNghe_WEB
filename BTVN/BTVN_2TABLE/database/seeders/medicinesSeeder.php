<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class medicinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
        DB::table('medicines')->insert([
        'name' => $faker->word . ' ' . $faker->word,
        'brand' => $faker->company,
        'dosage' => $faker->randomElement(['10mg tablets',
        '500mg capsules', '100ml syrup']),
        'form' => $faker->randomElement(['Tablet', 'Capsule',
        'Syrup']),
        'price' => $faker->randomFloat(2, 1, 100),
        'stock' => $faker->numberBetween(10, 100),
        'created_at' => now(),
        'updated_at' => now(),
        ]);
    }
}
}
