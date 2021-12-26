<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFinesTable4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fines', function (Blueprint $table) {
            $table->dropForeign(['license_holder_id']);
            $table->dropColumn('license_holder_id');

            $table->dropForeign(['offense_id']);
            $table->dropColumn('offense_id');

            $table->dropForeign(['vehicle_class_id']);
            $table->dropColumn('vehicle_class_id');

            $table->dropForeign(['policeman_id']);
            $table->dropColumn('policeman_id');

            $table->dropForeign(['payment_status']);
            $table->dropColumn('payment_status');

            $table->dropColumn('fine_issued_date');
            $table->dropColumn('payment_date');

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
