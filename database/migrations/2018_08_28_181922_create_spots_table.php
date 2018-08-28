<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->integer('user_id')->unsigned();            
            $table->integer('location_id')->unsigned();           
            $table->string('phone_no');
            $table->string('avatar');
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
        Schema::dropIfExists('spots');
        $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
         $table->foreign('location_id')
                  ->references('id')->on('locations')
                  ->onDelete('cascade');
    }
}
