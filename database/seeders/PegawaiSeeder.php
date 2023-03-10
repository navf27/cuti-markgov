<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->insert([
            'nama_depan'        => 'Suhariyono',
            'nama_belakang'     => ' ',
            'id_user'           => 1,
            'id_divisi'         => 3,
            'tgl_lahir'         => '1995-11-10',
            'no_hp'             => '082212345678',
            'jenis_kelamin'     => 'Laki - Laki',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Endang',
            'nama_belakang'     => 'Wiyanti',
            'id_user'           => 2,
            'id_divisi'         => 3,
            'tgl_lahir'         => '1995-11-10',
            'no_hp'             => '082212345678',
            'jenis_kelamin'     => 'Perempuan',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Nur',
            'nama_belakang'     => 'Wachid',
            'id_user'           => 3,
            'id_divisi'         => 3, 
            'tgl_lahir'         => '1981-11-10',
            'no_hp'             => '082212345374',
            'jenis_kelamin'     => 'Laki - Laki',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Achmad ',
            'nama_belakang'     => 'Jumain',
            'id_user'           => 4,
            'id_divisi'         => 2,
            'tgl_lahir'         => '1981-11-10',
            'no_hp'             => '082212345374',
            'jenis_kelamin'     => 'Laki - Laki',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);
       
        DB::table('pegawais')->insert([
            'nama_depan'        => 'Yoshinda Dwi',
            'nama_belakang'     => 'Yuliastutik',
            'id_user'           => 5,
            'id_divisi'         => 3,
            'tgl_lahir'         => '1981-11-10',
            'no_hp'             => '082212345374',
            'jenis_kelamin'     => 'Perempuan',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Andy',
            'nama_belakang'     => 'Putranto',
            'id_user'           => 6,
            'id_divisi'         => 3, 
            'tgl_lahir'         => '1981-11-10',
            'no_hp'             => '082212345374',
            'jenis_kelamin'     => 'Laki - Laki',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Ir. Supartono, ',
            'nama_belakang'     => 'MM',
            'id_user'           => 7,
            'id_divisi'         => 1,
            'tgl_lahir'         => '1981-11-10',
            'no_hp'             => '082212345374',
            'jenis_kelamin'     => 'Laki - Laki',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Fauziah Dwi',
            'nama_belakang'     => 'Sari',
            'id_user'           => 8,
            'id_divisi'         => 3, 
            'tgl_lahir'         => '1981-11-10',
            'no_hp'             => '082212345374',
            'jenis_kelamin'     => 'Perempuan',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Asgar',
            'nama_belakang'     => 'Irawan',
            'id_user'           => 9,
            'id_divisi'         => 3, 
            'tgl_lahir'         => '1981-11-10',
            'no_hp'             => '082212345374',
            'jenis_kelamin'     => 'Laki - Laki',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Brahmatya Adi',
            'nama_belakang'     => 'Sasono',
            'id_user'           => 10,
            'id_divisi'         => 3, 
            'tgl_lahir'         => '1981-11-10',
            'no_hp'             => '082212345374',
            'jenis_kelamin'     => 'Laki - Laki',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Dimas Agus',
            'nama_belakang'     => 'Wahyudi',
            'id_user'           => 11,
            'id_divisi'         => 3, 
            'tgl_lahir'         => '1981-11-10',
            'no_hp'             => '082212345374',
            'jenis_kelamin'     => 'Laki - Laki',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Habibulloh',
            'nama_belakang'     => ' ',
            'id_user'           => 12,
            'id_divisi'         => 3, 
            'tgl_lahir'         => '1981-11-10',
            'no_hp'             => '082212345374',
            'jenis_kelamin'     => 'Laki - Laki',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Nabila',
            'nama_belakang'     => 'Alma',
            'id_user'           => 13,
            'id_divisi'         => 3, 
            'tgl_lahir'         => '1981-11-10',
            'no_hp'             => '082212345374',
            'jenis_kelamin'     => 'Perempuan',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Arie',
            'nama_belakang'     => 'Sheva',
            'id_user'           => 14,
            'id_divisi'         => 3, 
            'tgl_lahir'         => '1981-11-10',
            'no_hp'             => '082212345374',
            'jenis_kelamin'     => 'Laki - Laki',
            'alamat'            => 'Kayoon Street, Embong Kaliasin, Surabaya',
            'jum_cuti'          => 12,
        ]);

    }
}
