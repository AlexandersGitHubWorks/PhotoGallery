<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@mail.com',
                'password' => bcrypt('password')
            ]);
        }
    }
}
