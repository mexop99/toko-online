<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin9',
            'email' => 'admin9@gmail.com',
            'username' => 'admin9',
            'password' => Hash::make('12345678'),
            'roles'=> json_encode('ADMIN'),
            'address'=> 'sidoarjo,jatim',
            'avatar' => 'default.png',
            'status'=>'ACTIVE'
        ]);
    }
}
