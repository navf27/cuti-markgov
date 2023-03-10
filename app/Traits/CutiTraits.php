<?php

namespace App\Traits;

use App\Models\Cuti;
use App\Models\JadwalCuti;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Str;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\File;

trait CutiTraits
{
    public function countCutiDays($awal_cuti, $akhir_cuti)
    {
        $awal_cuti_time = strtotime($awal_cuti);
        $akhir_cuti_time = strtotime($akhir_cuti);

        $haricuti = array();
        // cek weekend
        for ($i = $awal_cuti_time; $i <= $akhir_cuti_time; $i += (60 * 60 * 24)) {
            if (date('w', $i) !== '0' && date('w', $i) !== '6') {
                $haricuti[] = $i;
            }
        }
        $jumlah_cuti = count($haricuti);
        // error_log($awal_cuti);
        // error_log($jumlah_cuti);
        // error_log("----------------");

        // cek libur nasional
        $libur_nasional = JadwalCuti::where('tipe', JadwalCuti::LIBUR_NASIONAL)->get();
        $count_libur = 0;
        $awal_cuti = date('m-d', strtotime($awal_cuti));
        $akhir_cuti = date('m-d', strtotime($akhir_cuti));
        foreach ($libur_nasional as $value) {
            $tanggal_akhir = date('Y-m-d', strtotime($value->tgl_akhir . ' +1 day'));
            $period_libur = new DatePeriod(
                new DateTime($value->tgl_awal),
                new DateInterval('P1D'),
                new DateTime($tanggal_akhir)
            );

            foreach ($period_libur as $item) {
                $tanggal_libur = $item->format('m-d');
                // error_log($tanggal_libur);
                if ($tanggal_libur >= $awal_cuti && $tanggal_libur <= $akhir_cuti) {
                    $count_libur += 1;
                }
            }
        }
        // error_log($count_libur);
        $jumlah_cuti -= $count_libur;
        return $jumlah_cuti;
    }

    public function addCutiBersama($cuti_bersama)
    {
        $user = User::where('role', User::ADMIN)->first();
        $pegawai = Pegawai::all();
        $check = false;
        foreach ($pegawai as $value) {
            // cek cuti bersama setiap pegawai sudah dibuat atau belum
            foreach ($value->cuti as $cuti) {
                if ($cuti_bersama->id == $cuti->id_jadwal_cuti && $cuti_bersama->tgl_awal == $cuti->tgl_awal_cuti) {
                    $check = true;
                }
            }

            // jika belum menambahkan data cuti dan mengurangi quota cuti pegawai
            $direktur = User::find(7);
            if ($check == false) {
                $cuti = new Cuti();
                $cuti->tgl_awal_cuti = $cuti_bersama->tgl_awal;
                $cuti->tgl_akhir_cuti = $cuti_bersama->tgl_akhir;
                $cuti->id_pegawai = $value->id;
                $cuti->id_jadwal_cuti = $cuti_bersama->id;
                $cuti->keterangan = $cuti_bersama->keterangan;
                $cuti->status = Cuti::DITERIMA;
                $cuti->kategori = Cuti::CUTI_TAHUNAN;
                $cuti->mengetahui = $direktur->name;
                $cuti->menyetujui = $value->divisi->nama_kepala;
                $cuti->created_by = $user->id;
                $cuti->save();

                $jumlah_cuti_bersama = $this->countCutiDays($cuti_bersama->tgl_awal, $cuti_bersama->tgl_akhir);
                if ($value->jum_cuti > $jumlah_cuti_bersama) {
                    $value->jum_cuti -= $jumlah_cuti_bersama;
                } else {
                    $value->jum_cuti = 0;
                }
                $value->save();
            }
        }
    }

    public function getPathFile($value, $type)
    {
        $path = '/' . $type . '/' . $value->getclientoriginalName();
        File::delete(public_path($path));
        $tujuan_upload = $type;
        $value->move($tujuan_upload, $path);
        return $path;
    }

    public function generateNoSurat()
    {
        $date = date('my');
        $tgl_sekarang = strtotime(now());
        $bulan = date("m", $tgl_sekarang);
        $tahun = date("Y", $tgl_sekarang);
        $cuti = Cuti::query();
        //count all cuti this month and year
        $number = $cuti->whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->where('kategori', '!=', null)->count() + 1;
        //format number to 3 digit
        $number = sprintf('%03d', $number);
        //generate no surat
        $no_surat = $number . "/C/" . $date . '/SEP';
        //check if no surat already exist
        if ($cuti->where('no_surat', $no_surat)->exists()) {
            return $this->generateNoSurat();
        }
        return $no_surat;
    }
}
