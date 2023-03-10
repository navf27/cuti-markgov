<?php

namespace App\Providers;

use App\Models\Cuti;
use App\Models\Pegawai;
use App\Traits\CutiTraits;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\ServiceProvider;

class ViewPegawaiServiceProvider extends ServiceProvider
{
    use CutiTraits;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {

        // Using Closure based composers...
        View::composer('*', function ($view) use ($auth) {
            if ($auth->check()) {
                $user            = $auth->user();
                $pegawai_data    = Pegawai::where('id_user', $user->id)->first();

                $cuti_bulan = Cuti::where([
                    ['id_pegawai', $pegawai_data->id],
                    ['status', Cuti::DITERIMA]
                ])->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->get();
                $jumlah_cuti_bulan = 0;
                if ($cuti_bulan) {
                    foreach ($cuti_bulan as $cuti) {
                        $jumlah_cuti_bulan += $this->countCutiDays($cuti->tgl_awal_cuti, $cuti->tgl_akhir_cuti);
                    }
                }

                $cuti_tahun = Cuti::where([
                    ['id_pegawai', $pegawai_data->id],
                    ['status', Cuti::DITERIMA]
                ])->whereYear('created_at', now()->year)->get();
                $jumlah_cuti_tahun = 0;
                if ($cuti_tahun) {
                    foreach ($cuti_tahun as $cuti) {
                        $jumlah_cuti_tahun += $this->countCutiDays($cuti->tgl_awal_cuti, $cuti->tgl_akhir_cuti);
                    }
                }

                $pegawai_data->cuti_bulan = $jumlah_cuti_bulan;
                $pegawai_data->cuti_tahun = $jumlah_cuti_tahun;

                switch ($user->role) {
                    case '1':
                        $pegawai_data->role = "Admin";
                        break;
                    case '2':
                        $pegawai_data->role = "Kepala divisi";
                        break;
                    default:
                        $pegawai_data->role = "Pegawai";
                        break;
                }

                $view->with('pegawai_data', $pegawai_data);
            }
        });
    }
}
