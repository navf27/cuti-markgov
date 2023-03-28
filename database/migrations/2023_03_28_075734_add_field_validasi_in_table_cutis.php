<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldValidasiInTableCutis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cutis', function (Blueprint $table) {
            $table->enum("validasi", [1,2])->nullable()->after("acc_kepala"); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cutis', function (Blueprint $table) {
            $table->dropColumn("validasi");
        });
    }
}
