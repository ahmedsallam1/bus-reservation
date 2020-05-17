<?php

use Illuminate\Database\Seeder;

class LineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stations = App\Station::all();

        $stations->each(function ($station) use ($stations) {
            $station->lines()->attach(
                $stations->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}