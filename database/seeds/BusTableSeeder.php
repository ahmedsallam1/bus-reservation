<?php

use Illuminate\Database\Seeder;

class BusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Bus::class, 20)->create()->each(function ($bus) {
            $seats = factory(\App\Seat::class, 12)->make();
            $bus->seats()->saveMany($seats);
        });
    }
}
