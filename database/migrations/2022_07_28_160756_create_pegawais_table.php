<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_divisi')->nullable();
            $table->foreign('id_divisi')->references('id')->on('divisis');
            $table->string('nama_depan');
            $table->string("nama_belakang");
            $table->date("tgl_lahir");
            $table->string("no_hp");
            $table->string("jenis_kelamin");
            $table->String('alamat')->nullable();
            $table->integer('jum_cuti')->nullable();
            $table->char('id_desa')->nullable();
            $table->foreign('id_desa')->references('id')->on('villages');
            $table->char('id_kecamatan')->nullable();
            $table->foreign('id_kecamatan')->references('id')->on('districts');
            $table->char('id_kota')->nullable();
            $table->foreign('id_kota')->references('id')->on('regencies');
            $table->char('id_provinsi')->nullable();
            $table->foreign('id_provinsi')->references('id')->on('provinces');
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
        Schema::dropIfExists('pegawais');
    }
}
