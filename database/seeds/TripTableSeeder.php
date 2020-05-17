<?php

use Illuminate\Database\Seeder;

class TripTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buses = App\Bus::all();
        $lines = \App\Line::all();

        $lines->each(function ($line) use ($buses) {
            $line->trips()->attach(
                $buses->random(1)->pluck('id')->toArray()
            );
        });
    }
}
