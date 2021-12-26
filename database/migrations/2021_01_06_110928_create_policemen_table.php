<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicemenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('policemen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('mobile_number')->nullable();
            $table->date('dob')->nullable();
            $table->string('postal_address')->nullable();
            $table->integer('registration_number')->unique()->nullable();
            
            $table->integer('division_id')->unsigned()->nullable();
            $table->foreign('division_id')->references('id')->on('police_divisions')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('policemen');
    }
}
