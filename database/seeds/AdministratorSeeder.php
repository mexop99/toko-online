<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email= "admin@mail.com";
        $administrator->roles= json_encode(["ADMIN"]);
        $administrator->password= \Hash::make("12345678");
        $administrator->avatar= "default.png";
        $administrator->address= "Jl. Kutisari 2/8";
        $administrator->save();
        $this->command->info("User Admin Berhasil dibuat!"); 




    }
}
