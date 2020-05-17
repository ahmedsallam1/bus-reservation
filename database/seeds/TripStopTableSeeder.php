<?php

use Illuminate\Database\Seeder;

class TripStopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trips = \App\Trip::all();
        $lines = \App\Line::all();

        $trips->each(function ($trip) use ($lines) {
            $trip->stops()->attach(
                $lines->random(3)->pluck('id')->toArray()
            );
        });
    }
}
