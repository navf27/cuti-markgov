<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_cutis', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->integer('tipe')->comment('1:cuti bersama, 2:libur nasional');
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
        Schema::dropIfExists('jadwal_cutis');
    }
}
