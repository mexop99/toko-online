<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        foreach (range(0, 10) as $i) {
            DB::table('product_order')->insert([
                'order_id' => $faker->numberBetween(1,6),
                'product_id' => $faker->numberBetween(3,5),
                'quantity' => $faker->numberBetween(1,100)
            ]);
        }
    }
}