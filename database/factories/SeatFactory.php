<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Seat::class, function (Faker $faker) {
    return [
        'reference' => $faker->unique()->randomNumber(5),
    ];
});
