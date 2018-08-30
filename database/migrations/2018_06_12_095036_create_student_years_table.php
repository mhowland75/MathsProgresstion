<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_years', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('unit_id');
            $table->string('description');
            $table->boolean('active');
            $table->boolean('student_login_active');
            $table->timestamps();
        });
        return redirect()->back();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_years');
    }
}
