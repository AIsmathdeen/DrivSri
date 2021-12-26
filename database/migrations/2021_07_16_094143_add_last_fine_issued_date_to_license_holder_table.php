<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastFineIssuedDateToLicenseHolderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('license_holders', function (Blueprint $table) {
            $table->date('last_fine_issued_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('license_holders', function (Blueprint $table) {
            $table->dropColumn('last_fine_issued_date');
        });
    }
}
