<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisis')->insert([
            'nama_divisi'   => 'Direktur',
            'nama_kepala'   => 'Ir. Supartono, MM',
            'ttd'           => '/images/ttd_direktur.png'
        ]);

        DB::table('divisis')->insert([
            'nama_divisi'   => 'Manajer',
            'nama_kepala'   => 'Achmad Jumain',
            'ttd'           => '/images/ttd.png'
        ]);

        DB::table('divisis')->insert([
            'nama_divisi'   => 'Markgov',
            'nama_kepala'   => 'Yoshinda Dwi Yuliastutik',
            'ttd'           => '/images/ttd.png'
        ]);
    }
}
