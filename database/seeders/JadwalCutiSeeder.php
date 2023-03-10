<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwal_cutis')->insert([
            'keterangan' => "Tahun baru masehi",
            'tgl_awal'   => '2022-01-01',
            'tgl_akhir'  => '2022-01-01',
            'tipe'       => 2
        ]);

        DB::table('jadwal_cutis')->insert([
            'keterangan' => "Hari kemerdekaan Indonesia",
            'tgl_awal'   => '2022-08-17',
            'tgl_akhir'  => '2022-08-17',
            'tipe'       => 2
        ]);

        DB::table('jadwal_cutis')->insert([
            'keterangan' => "Hari raya natal",
            'tgl_awal'   => '2022-12-25',
            'tgl_akhir'  => '2022-12-25',
            'tipe'       => 2
        ]);
    }
}
