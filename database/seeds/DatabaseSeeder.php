<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            BusTableSeeder::class,
            StationTableSeeder::class,
            LineTableSeeder::class,
            SeatsTableSeeder::class,
            TripTableSeeder::class,
            TripStopTableSeeder::class,
        ]);
    }
}
