<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dictionary;
use Faker\Generator as Faker;

$factory->define(Dictionary::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'type' => $faker->randomElement(["faculty","speciality","department","group","course"]),
        'code' => $faker->word,
    ];
});
