<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'Suhariyono',
            'email'=> 'harzaqi@gmail.com',
            'password'=>Hash::make('12345678'),
            'role' => 1
        ]);

        // DB::table('users')->insert([
        //     'name'=> 'Ari Hermawan',
        //     'email'=> 'endang@scomptec.co.id',
        //     'password'=>Hash::make('12345678'),
        //     'role' => 1
        // ]);

        DB::table('users')->insert([
            'name'=> 'Endang Wiyanti',
            'email'=> 'endang@scomptec.co.id',
            'password'=>Hash::make('12345678'),
            'role' => 1
        ]);

        DB::table('users')->insert([
            'name'=> 'Nur Wakhid',
            'email'=> 'nurwakhid@outlook.com',
            'password'=>Hash::make('12345678'),
            'role' => 3
        ]);

        DB::table('users')->insert([
            'name'=> 'Achmad Jumain',
            'email'=> 'achmadjumain48@gmail.com',
            'password'=>Hash::make('12345678'),
            'role' => 2
        ]);

        DB::table('users')->insert([
            'name'=> 'Yoshinda Dwi Yuliastuti',
            'email'=> 'yoshinda82@gmail.com',
            'password'=>Hash::make('12345678'),
            'role' => 2
        ]);

        DB::table('users')->insert([
            'name'=> 'Andy Putranto',
            'email'=> 'andy.khochenk@gmail.com',
            'password'=>Hash::make('12345678'),
            'role' => 3
        ]);

        DB::table('users')->insert([
            'name'=> 'Ir. Supartono, MM',
            'email'=> 'pakton.arj@gmail.com',
            'password'=>Hash::make('12345678'),
            'role' => 2
        ]);

        DB::table('users')->insert([
            'name'=> 'Fauziah Dwi Sari',
            'email'=> 'faudwis@gmail.com',
            'password'=>Hash::make('12345678'),
            'role' => 3
        ]);

        DB::table('users')->insert([
            'name'=> 'Asgar Irawan',
            'email'=> 'irmawanasgar@yahoo.co.id',
            'password'=>Hash::make('12345678'),
            'role' => 3
        ]);

        DB::table('users')->insert([
            'name'=> 'Brahmatya Adi Sasono',
            'email'=> 'bramantyaadi44@gmail.com',
            'password'=>Hash::make('12345678'),
            'role' => 3
        ]);

        DB::table('users')->insert([
            'name'=> 'Dimas Agus Wahyudi',
            'email'=> 'dimas2.ds4@gmail.com',
            'password'=>Hash::make('12345678'),
            'role' => 3
        ]);

        DB::table('users')->insert([
            'name'=> 'Habibulloh',
            'email'=> 'bullahhabib10@gmail.com',
            'password'=>Hash::make('12345678'),
            'role' => 3
        ]);

        DB::table('users')->insert([
            'name'=> 'Nabila Alma',
            'email'=> 'nabilaalma.acdmj13@gmail.com',
            'password'=>Hash::make('12345678'),
            'role' => 3
        ]);

        DB::table('users')->insert([
            'name'=> 'arie sheva',
            'email'=> 'arie.sheva09@gmail.com',
            'password'=>Hash::make('12345678'),
            'role' => 1
        ]);
    }
}
