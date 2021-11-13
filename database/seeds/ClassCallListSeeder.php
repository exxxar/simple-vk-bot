<?php

use Illuminate\Database\Seeder;

class ClassCallListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ///factory(\App\ClassCallList::class, 5)->create();

        \App\ClassCallList::truncate();

        \App\ClassCallList::create([
            'title' => "Первая пара",
            'index' => 1,
            'start_at' => "08:00",
            'end_at' => "09:30",
        ]);

        \App\ClassCallList::create([
            'title' => "Вторая пара",
            'index' => 2,
            'start_at' => "09:50",
            'end_at' => "11:20",
        ]);

        \App\ClassCallList::create([
            'title' => "Третья пара",
            'index' => 3,
            'start_at' => "11:30",
            'end_at' => "13:00",
        ]);

        \App\ClassCallList::create([
            'title' => "Четвертая пара",
            'index' => 4,
            'start_at' => "13:10",
            'end_at' => "14:45",
        ]);

        \App\ClassCallList::create([
            'title' => "Пятая пара",
            'index' => 5,
            'start_at' => "14:50",
            'end_at' => "16:15",
        ]);

        \App\ClassCallList::create([
            'title' => "Шестая пара",
            'index' => 6,
            'start_at' => "16:20",
            'end_at' => "17:50",
        ]);

        \App\ClassCallList::create([
            'title' => "Седьмая пара",
            'index' => 7,
            'start_at' => "17:55",
            'end_at' => "19:15",
        ]);

    }
}
