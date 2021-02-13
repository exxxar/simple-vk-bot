<?php

use Illuminate\Database\Seeder;

class KnowlegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Knowledge::truncate(); //сброс старых данных из таблицы

        \App\Knowledge::create([
           'keyword'=>"привет",
           'answer'=>"Ку, бро!",
           'is_active'=>true
        ]);

        \App\Knowledge::create([
            'keyword'=>"пока",
            'answer'=>"Давай до свидания",
            'is_active'=>true
        ]);

    }
}
