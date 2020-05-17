<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use \App\Bus;

$factory->define(Bus::class, function (Faker $faker) {
    return [
        'reference' => $faker->unique()->randomNumber(5),
    ];
});
