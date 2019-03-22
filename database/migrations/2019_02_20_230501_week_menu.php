<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WeekMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('week_menus', function (Blueprint $table) { 
            $table->increments('id');
            $table->date('cooking_date');
            $table->string('kind');
            $table->string('menu_name');
            $table->integer('menu_id')->nullable();
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
        Schema::drop('week_menus'); 
    }
}
