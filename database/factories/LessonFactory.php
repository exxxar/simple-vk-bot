<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {


    $max_fac = \App\Dictionary::where("type", "faculty")->count();
    $max_dep = \App\Dictionary::where("type", "department")->count();
    $max_spec = \App\Dictionary::where("type", "speciality")->count();
    $max_group = \App\Dictionary::where("type", "group")->count();
    $max_course = \App\Dictionary::where("type", "course")->count();

    return [
        'auditory_number' => $faker->numberBetween(400,421),
        'teacher_full_name' => $faker->name,
        'teacher_email' => $faker->email,
        'faculty' => $faker->numberBetween(1, $max_fac),
        'speciality' => $faker->numberBetween(1, $max_spec),
        'department' => $faker->numberBetween(1, $max_dep),
        'group' => $faker->numberBetween(1, $max_group),
        'course' => $faker->numberBetween(1, $max_course),
    ];
});
