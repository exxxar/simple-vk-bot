<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {


    $max_fac = \App\Dictionary::where("type", "faculty")->count();
    $max_dep = \App\Dictionary::where("type", "department")->count();
    $max_spec = \App\Dictionary::where("type", "speciality")->count();
    $max_group = \App\Dictionary::where("type", "group")->count();
    $max_course = \App\Dictionary::where("type", "course")->count();

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'faculty' => $faker->numberBetween(1, $max_fac),
        'speciality' => $faker->numberBetween(1, $max_spec),
        'department' => $faker->numberBetween(1, $max_dep),
        'group' => $faker->numberBetween(1, $max_group),
        'course' => $faker->numberBetween(1, $max_course),
        'vk_url' => $faker->regexify('[A-Za-z0-9]{1000}'),
        'true_first_name' => $faker->firstName,
        'true_last_name' => $faker->lastName,
        'student_id' => null,
        'user_id' => null,
        'blocked_at' => null,
    ];
});
