<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffencesHasFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offences_has_fines', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('offences_id')->unsigned()->nullable();
            $table->foreign('offences_id')->references('id')->on('offenses')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('fine_id')->unsigned()->nullable();
            $table->foreign('fine_id')->references('id')->on('fines')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::table('offences_has_fines', function (Blueprint $table) {
            //
        });
    }
}
