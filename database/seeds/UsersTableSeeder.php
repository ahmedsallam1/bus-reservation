<?php

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
        App\User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
    }
}
