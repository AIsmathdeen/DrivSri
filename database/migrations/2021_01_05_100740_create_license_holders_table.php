<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //change the foreign key back to not nullable
        Schema::create('license_holders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('license_no')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('mobile_no')->nullable();
            $table->string('postal_address')->nullable();
            $table->date('dob')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->integer('total_demerit_points');

            $table->integer('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('license_statuses')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('license_holders');
    }
}
