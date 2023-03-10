<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\JadwalCuti;
use App\Models\Pegawai;
use App\Models\Setting;
use App\Models\User;
use App\Traits\CutiTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    use CutiTraits;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // otomatis add cuti bersama
        $cutiBersama = JadwalCuti::where('tipe', JadwalCuti::CUTI_BERSAMA)->get();
        foreach ($cutiBersama as $cuti_bersama) {
            $tgl_akhir = date('Y-m-d', strtotime('+1 day', strtotime($cuti_bersama->tgl_akhir)));
            if (now() >= $cuti_bersama->tgl_awal && now() <= $tgl_akhir) {
                $this->addCutiBersama($cuti_bersama);
            }
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->role;
        if ($role == User::ADMIN) {
            toast()->success('Success', 'Berhasil login sebagai Admin');
        } else if ($role == User::KEPALA) {
            toast()->success('Success', 'Berhasil login sebagai Kepala divisi');
        } else if ($role == User::PEGAWAI) {
            toast()->success('Success', 'Berhasil login sebagai Pegawai');
        } else {
            alert()->error('Error', 'Terjadi kesalahan saat login');
            return redirect()->to('/');
        }
        return redirect()->route('home');
    }

    public function home()
    {
        // otomatis reset cuti setiap tahun
        $tanggal_sekarang = date('Y-m-d');
        $tahun_sekarang = date('Y');

        DB::beginTransaction();
        try {
            $cuti_reset = Cuti::whereYear('tgl_awal_cuti', $tahun_sekarang)->where('kategori', Cuti::RESET_CUTI)->get();
            if ($cuti_reset->count() == 0) {
                $pegawai = Pegawai::all();
                foreach ($pegawai as $value) {
                    $direktur               = User::find(7);
                    $cuti                   = new Cuti();
                    $cuti->tgl_awal_cuti    = $tanggal_sekarang;
                    $cuti->tgl_akhir_cuti   = $tanggal_sekarang;
                    $cuti->id_pegawai       = $value->id;
                    $cuti->keterangan       = "Reset Kuota Cuti Tahunan";
                    $cuti->sisa_cuti        = $value->jum_cuti;
                    $cuti->kategori         = Cuti::RESET_CUTI;
                    $cuti->mengetahui       = $direktur->name;
                    $cuti->menyetujui       = $value->divisi->nama_kepala;
                    $cuti->created_by       = Auth::user()->id;
                    $cuti->save();
                    
                    $value->jum_cuti = 12;
                    $value->save();
                }
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => '500',
                'error' => $th->getMessage()
            ], 500);
        }
        
        $user = Auth::user();
        $pegawai = Pegawai::where('id_user', $user->id)->first();
        $tgl_sekarang = strtotime(now());
        $bulan = date("m", $tgl_sekarang);
        $tahun = date("Y", $tgl_sekarang);

        $id_pegawai = array();
        if ($user->role == User::ADMIN || $user->id == 7) {
            $cuti = Cuti::where('kategori', '!=', Cuti::RESET_CUTI)->get();
            $id_pegawai = Pegawai::where('id', '!=', 7)->get();
            $jumlah_pegawai = $id_pegawai ? count($id_pegawai) : 0;
        } else if ($user->role == User::KEPALA) {
            $id_pegawai = Pegawai::where('id_divisi', $pegawai->divisi->id)->pluck('id')->toArray();
            $jumlah_pegawai = $id_pegawai ? count($id_pegawai) : 0;
            $cuti = Cuti::where('kategori', '!=', Cuti::RESET_CUTI)->whereIn('id_pegawai', $id_pegawai)->get();
        } else {
            $cuti = Cuti::where([['id_pegawai', $pegawai->id], ['kategori', '!=', Cuti::RESET_CUTI]])->get();
        }

        $jumlah_cuti = $cuti ? $cuti->count() : 0;
        $jumlah_pegawai = $id_pegawai ? count($id_pegawai) : 0;
        $jumlah_pengajuan = $cuti->where('status', Cuti::PENGAJUAN) ? $cuti->where('status', Cuti::PENGAJUAN)->count() : 0;
        $jumlah_diterima = $cuti->where('status', Cuti::DITERIMA) ? $cuti->where('status', Cuti::DITERIMA)->count() : 0;
        $jumlah_ditolak = $cuti->where('status', Cuti::DITOLAK) ? $cuti->where('status', Cuti::DITOLAK)->count() : 0;

        if ($user->role == User::KEPALA) {
            if ($user->id == 7) {
                $notifikasi = Cuti::where([
                    ['status', Cuti::PENGAJUAN], ['acc_kepala', 1]
                ])
                    ->whereYear('tgl_awal_cuti', $tahun)->whereMonth('tgl_awal_cuti', $bulan)
                    ->orderBy('id', 'desc')->get();
            } else {
                $notifikasi = Cuti::where([
                    ['status', Cuti::PENGAJUAN], ['acc_kepala', 0]
                ])
                    ->whereIn('id_pegawai', $id_pegawai)->whereYear('tgl_awal_cuti', $tahun)->whereMonth('tgl_awal_cuti', $bulan)
                    ->orderBy('id', 'desc')->get();
            }
        } else {
            $notifikasi = Cuti::where('id_pegawai', $pegawai->id)->whereYear('tgl_awal_cuti', $tahun)->whereMonth('tgl_awal_cuti', $bulan)->orderBy('id', 'desc')->get();
        }

        return view('home', compact('jumlah_cuti', 'jumlah_pengajuan', 'jumlah_diterima', 'jumlah_ditolak','jumlah_pegawai' ,'notifikasi'));
    }

    public function changeMode(Request $request)
    {
        DB::beginTransaction();
        try {
            $setting = Setting::find(1);
            $setting->dark_mode = $request->dark_mode;
            $setting->save();
            DB::commit();
            return response()->json([
                'status' => 200,
                'data' => 'Mode berhasil diubah'
            ]);
        } catch (Exception $err) {
            DB::rollback();
            return response()->json([
                'status' => '500',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function changeAvatar(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'avatar' => 'image',
            ]);

            $user = User::find(Auth::user()->id);
            if ($request->file('avatar')) {
                $user->photo = $this->getPathFile($request->file('avatar'), 'avatar');
            }
            if ($request->name){
                $user->name = $request->name;
            }
            $user->save();
            DB::commit();
            return response()->json([
                'status' => 200,
                'data' => 'Avatar berhasil diubah'
            ]);
        } catch (Exception $err) {
            DB::rollback();
            return response()->json([
                'status' => '500',
                'error' => $err->getMessage()
            ], 500);
        }
    }
}
