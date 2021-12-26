<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOffencessTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offenses', function (Blueprint $table) {
            $table->dropColumn(['section_of_act', 'provision', 'fine_amount','demerit_point','created_at','updated_at']);

            $table->integer('license_holder_id')->unsigned()->index();
            $table->foreign('license_holder_id')->references('id')->on('license_holders')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('policeman_id')->unsigned()->index()->nullable();
            $table->foreign('policeman_id')->references('id')->on('policemen')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('offense_id')->unsigned()->index()->nullable();
            $table->foreign('offense_id')->references('id')->on('offenses')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('vehicle_class_id')->unsigned()->index()->nullable();
            $table->foreign('vehicle_class_id')->references('id')->on('vehicle_class')->onDelete('cascade')->onUpdate('cascade');

            $table->string('fine_issued_date')->nullable();

            $table->integer('payment_status')->unsigned()->index()->nullable();
            $table->foreign('payment_status')->references('id')->on('payment_statuses')->onDelete('cascade')->onUpdate('cascade');

            $table->date('payment_date')->nullable();
            $table->integer('total_fine_amount')->nullable();
            $table->integer('total_demerit_points')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offenses', function (Blueprint $table) {
            //
        });
    }
}
