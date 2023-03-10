<?php

namespace App\Console\Commands;

use App\Models\Pegawai;
use Illuminate\Console\Command;

class ResetCutiYearly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:cuti-pegawai-yearly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset jumlah cuti pegawai setiap tahun';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pegawai = Pegawai::all();
        foreach ($pegawai as $value) {
            $value->jum_cuti = 12;
            $value->save();
        }
    }
}
