<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFinesTable5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fines', function (Blueprint $table) {
            $table->string('section_of_act')->nullable()->after('demerit_points');
            $table->string('provision')->nullable()->after('demerit_points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fines', function (Blueprint $table) {
            //
        });
    }
}
