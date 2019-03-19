<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Admintable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrator_privileges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('access_level');
            $table->timestamps();
          });
          DB::table('administrator_privileges')->insert(
              ['user_id' => 1, 'access_level' => 1]
          );
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
