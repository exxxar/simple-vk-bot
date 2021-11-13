<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DictionarySeeder::class);
        $this->call(ClassCallListSeeder::class);
        $this->call(LessonSeeder::class);

         $this->call(ProfileSeeder::class);
         $this->call(StudentSeeder::class);

    }
}
