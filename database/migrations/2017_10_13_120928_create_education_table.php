<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('subject_id');
          $table->string('subject');
          $table->string('description',2000);
          $table->string('explanation', 8000);
          $table->string('video');
          $table->string('image');
          $table->integer('visibility');
          $table->integer('views');
          $table->integer('created_by');
          $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('education');
    }
}
