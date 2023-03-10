<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(DivisiSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(IndoRegionSeeder::class);
        $this->call(JadwalCutiSeeder::class);
    }
}
