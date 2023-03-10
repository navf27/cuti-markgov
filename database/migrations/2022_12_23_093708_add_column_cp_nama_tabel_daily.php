<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCpNamaTabelDaily extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_report', function (Blueprint $table) {
            $table->string('nama_dinas')->nullable()->after('id_user');
            $table->bigInteger('no_cp')->nullable()->after('nama_dinas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_report', function (Blueprint $table) {
            $table->dropColumn('nama_dinas');
            $table->dropColumn('no_cp');
        });
    }
}
