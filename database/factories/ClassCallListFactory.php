<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ClassCallList;
use Faker\Generator as Faker;

$factory->define(ClassCallList::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'index' => $faker->numberBetween(1, 7),
        'start_at' => $faker->word,
        'end_at' => $faker->word,
    ];
});
