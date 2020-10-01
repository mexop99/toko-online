<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('orders')->insert([
        //     'user_id'
        // ]);

        factory(App\Order::class, 10)->create()->each(function ($order){
            $order->post()->save(factory(App\Post::class)->make());
        });
    }
}
