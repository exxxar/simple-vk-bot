<?php

use Illuminate\Database\Seeder;

class DictionarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(\App\Dictionary::class, 5)->create();
        //"faculty","speciality","department","group","course"

        \App\Dictionary::truncate();

        \App\Dictionary::create([
            'title' => "Физико-технический факультет",
            'type' => "faculty",
            'code' => "4",
        ]);

        \App\Dictionary::create([
            'title' => "Кафедра Компьютерных технологий",
            'type' => "department",
            'code' => "",
        ]);

        \App\Dictionary::create([
            'title' => "Информатика и вычислительная техника (ИВТ)",
            'type' => "speciality",
            'code' => "09.03.01",
        ]);

        \App\Dictionary::create([
            'title' => "Информатика и вычислительная техника (ИВТ)",
            'type' => "speciality",
            'code' => "09.04.01",
        ]);


        for ($i = 1; $i <= 4; $i++)
            \App\Dictionary::create([
                'title' => "Курс $i",
                'type' => "course",
                'code' => "бакалавриат",
            ]);

        for ($i = 1; $i <= 2; $i++)
            \App\Dictionary::create([
                'title' => "Курс $i",
                'type' => "course",
                'code' => "магистратура",
            ]);

        for ($i = 1; $i < 8; $i++)
            \App\Dictionary::create([
                'title' => "ИВТ-$i",
                'type' => "group",
                'code' => "",
            ]);

    }
}
