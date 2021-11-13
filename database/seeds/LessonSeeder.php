<?php

use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Lesson::truncate();

        factory(\App\Lesson::class, 5)->create();
    }
}
