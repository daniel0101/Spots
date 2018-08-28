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
            $table->unsignedInteger('user_id');            
            $table->unsignedInteger('location_id'); 
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
             $table->foreign('location_id')
                  ->references('id')->on('locations')
                  ->onDelete('cascade');
            $table->string('name');
            $table->string('address');
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
        
    }
}
