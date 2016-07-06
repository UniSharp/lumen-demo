<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'root',
            'password' => 'root',
            'name' => 'root',
            'sex' => 'male',
            'email' => 'root@example.com',
            'phone' => '0987654321',
            'address' => '台北市中正區重慶南路一段 10 號 10 樓 1008 室',
        ]);
    }
}
