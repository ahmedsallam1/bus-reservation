<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use \App\Station;

$factory->define(Station::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->city,
    ];
});
