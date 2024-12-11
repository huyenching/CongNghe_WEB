<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class Hardware_devicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('hardware_devices')->insert([
           'device_name'=> $faker->word,
           'type'=> $faker->randomElement(['Mouse', 'Keyboard', 'Headset']),
           'status'=>$faker->boolean,
           'center_id'=> $faker->numberBetween(1,10),
          
           
   ]);

    }
    }
}
