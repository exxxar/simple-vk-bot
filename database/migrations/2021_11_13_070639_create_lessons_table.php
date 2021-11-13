<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('auditory_number');
            $table->string('teacher_full_name');
            $table->string('teacher_email');
            $table->unsignedInteger('faculty')->default(1);
            $table->unsignedInteger('speciality')->default(1);
            $table->unsignedInteger('department')->default(1);
            $table->unsignedInteger('group')->default(1);
            $table->unsignedInteger('course')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
