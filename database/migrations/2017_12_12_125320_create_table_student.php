<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('students', function (Blueprint $table) {
          $table->increments('id');
          $table->string('student_id');
          $table->integer('student_year_id');
          $table->string('firstname');
          $table->string('surname');
          $table->string('dob');
          $table->string('dept');
          $table->string('course');
          $table->string('gcse_maths_grade');
          $table->string('primary_tutor');
          $table->integer('withdrawn');
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
        //
    }
}
