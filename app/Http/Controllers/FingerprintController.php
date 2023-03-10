<?php

namespace App\Http\Controllers;

use App\Imports\AbsenImport;
use App\Models\Cuti;
use App\Models\Fingerprint;
use App\Models\Pegawai;
use App\Models\User;
use App\Traits\CutiTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FingerprintController extends Controller
{
    use CutiTraits;

    public function checkFingerprint()
    {
        return view('fingerprint');
    }

    public function importExcel(Request $request)
    {
        // import excel to array
        $array = (new AbsenImport)->toArray($request->file('import'));
        $data = $array[0];

        // check format excel
        if ($data[20][5] == null) {
            if (!str_contains($data[20][5], '/')) {
                return redirect()->route('cuti.admin.fingerprint')->withErrors('format excel tidak sesuai');
            }
            return redirect()->route('cuti.admin.fingerprint')->withErrors('format excel tidak sesuai');
        }

        // mapping data tahun_bulan
        $tahun_bulan = str_replace('/', '-', $data[20][5]);
        $tahun_bulan = Carbon::parse($tahun_bulan)->format('Y-m');

        // check bulan
        if ($tahun_bulan != $request->tahun_bulan) {
            return redirect()->route('cuti.admin.fingerprint')->withErrors('Data tahun dan bulan yang diimportkan tidak sesuai dengan yang dipilih');
        }

        // input data ke database
        for ($i = 5; $i < 36; $i++) {
            if ($data[$i][0] != null) {
                $tanggal = str_replace('/', '-', $data[$i][5]);
                $tanggal = Carbon::parse($tanggal)->format('Y-m-d');

                $fingerprint                = new Fingerprint();
                $fingerprint->id_pegawai    = $request->pegawai;
                $fingerprint->tanggal       = $tanggal;
                $fingerprint->scan1         = $data[$i][11] == "" ? "-" : $data[$i][11];
                $fingerprint->scan2         = $data[$i][14] == "" ? "-" : $data[$i][14];
                $fingerprint->bulan_tahun   = $tahun_bulan;
                $fingerprint->is_libur      = $data[$i][19] == "libur rutin" ? true : false;
                $fingerprint->save();
            }
        }

        // compare data fingerprint dengan sistem
        $data_fingerprint = Fingerprint::where('bulan_tahun', $tahun_bulan)->get();
        foreach ($data_fingerprint as $value) {
            if ($value->scan1 == "-" && $value->scan2 == "-" && $value->is_libur == false) {
                $data_cuti = Cuti::where([
                    ['id_pegawai', $request->pegawai],
                    ['tgl_awal_cuti', '<=', $value->tanggal],
                    ['tgl_akhir_cuti', '>=', $value->tanggal],
                    ['status', Cuti::DITERIMA]
                ])->get();

                if ($data_cuti->count() == 0) {
                    $pegawai                = Pegawai::find($request->pegawai);
                    $direktur               = User::find(7);
                    $cuti                   = new Cuti();
                    $cuti->tgl_awal_cuti    = $value->tanggal;
                    $cuti->tgl_akhir_cuti   = $value->tanggal;
                    $cuti->id_pegawai       = $pegawai->id;
                    $cuti->keterangan       = "Tidak melakukan fingerprint";
                    $cuti->sisa_cuti        = $pegawai->jum_cuti;
                    $cuti->acc_kepala       = 1;
                    $cuti->status           = Cuti::DITERIMA;
                    $cuti->mengetahui       = $direktur->name;
                    $cuti->menyetujui       = $pegawai->divisi->nama_kepala;
                    $cuti->created_by       = Auth::user()->id;
                    $jumlah_cuti            = $this->countCutiDays($value->tanggal, $value->tanggal);
                    $pegawai->jum_cuti      -= $jumlah_cuti;
                    $pegawai->save();
                    $cuti->save();
                }
            }
        }

        return redirect()->route('cuti.admin.fingerprint')
            ->with('success', 'Berhasil menyimpan data');
    }

    public function getByMonth(Request $request)
    {
        $fingerprint = Fingerprint::where([
            ['bulan_tahun', $request->tahun_bulan],
            ['id_pegawai', $request->id_pegawai]
        ])->get();

        if ($fingerprint->count() > 0) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function destroy(Request $request)
    {
        $fingerprint = Fingerprint::where([
            ['bulan_tahun', $request->tahun_bulan],
            ['id_pegawai', $request->id_pegawai]
        ]);

        $array_tahun_bulan = explode('-', $request->tahun_bulan);
        $tahun = $array_tahun_bulan[0];
        $bulan = $array_tahun_bulan[1];

        $data_cuti = Cuti::where([
            ['id_pegawai', $request->id_pegawai],
            ['keterangan', "Tidak melakukan fingerprint"]
        ])->whereMonth('tgl_awal_cuti', $bulan)->whereYear('tgl_awal_cuti', $tahun)->get();

        // error_log($data_cuti->count());
        if($data_cuti->count() > 0){
            foreach ($data_cuti as $value) {
                $pegawai = Pegawai::find($request->id_pegawai);
                $jumlah_cuti = $this->countCutiDays($value->tgl_awal_cuti, $value->tgl_akhir_cuti);
                $pegawai->jum_cuti += $jumlah_cuti;
                $pegawai->save();
                $value->delete();
            }
        }

        $fingerprint->delete();
        return redirect()->route('cuti.admin.fingerprint')
            ->with('success', 'Berhasil menghapus data');
    }
}
