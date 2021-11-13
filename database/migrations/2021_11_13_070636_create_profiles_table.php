<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->unsignedInteger('faculty')->default(1);
            $table->unsignedInteger('speciality')->default(1);
            $table->unsignedInteger('department')->default(1);
            $table->unsignedInteger('group')->default(1);
            $table->unsignedInteger('course')->default(1);
            $table->string('vk_url', 1000)->nullable();
            $table->string('true_first_name')->nullable();
            $table->string('true_last_name')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamp('blocked_at')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
