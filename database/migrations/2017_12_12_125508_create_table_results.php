<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('results', function (Blueprint $table) {
          $table->increments('id');
          $table->string('student_id');
          $table->string('student_name');
          $table->string('completed');
          $table->string('results');
          $table->string('start_date');
          $table->string('date_started');
          $table->string('date_completed');
          $table->string('date_due');
          $table->string('quiz_name');
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
