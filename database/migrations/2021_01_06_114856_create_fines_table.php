<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fines', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('license_holder_id')->unsigned()->index();
            $table->foreign('license_holder_id')->references('id')->on('license_holders')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('offense_id')->unsigned()->index();
            $table->foreign('offense_id')->references('id')->on('offenses')->onDelete('cascade')->onUpdate('cascade');
 
            $table->string('fine_issued_date');
            $table->integer('fine_amount');
            $table->integer('demerit_points');

            $table->integer('vehicle_class_id')->unsigned()->index();
            $table->foreign('vehicle_class_id')->references('id')->on('vehicle_class')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('policeman_id')->unsigned()->index();
            $table->foreign('policeman_id')->references('id')->on('policemen')->onDelete('cascade')->onUpdate('cascade');

            $table->date('payment_date');
            $table->integer('payment_status')->unsigned()->index();
            $table->timestamps();

            $table->foreign('payment_status')->references('id')->on('payment_statuses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offenses');
    }
}
