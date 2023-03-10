<?php

namespace App\Http\Controllers;

use App\Imports\AbsenImport;
use App\Models\District;
use App\Models\Divisi;
use App\Models\Pegawai;
use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::with('divisi')->get();
        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisi = Divisi::where('nama_divisi', '!=', 'Direktur')->get();
        $provinsi = Province::all();
        $kota = Regency::all();
        $kecamatan = District::all();
        // dd($desa);
        return view('pegawai.create', compact('divisi', 'provinsi', 'kota', 'kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'divisi' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            // 'name' => 'required',
            'tgl_lahir' => 'required',
            'no_hp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            // 'jum_cuti' => 'required|integer',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
        ]);

        $user = new User();
        $user->name = $request->get('nama_depan') . " " . $request->get('nama_belakang');
        $user->email = $request->email;
        $user->password = Hash::make($request->get('password'));
        $user->role = $request->role;
        $user->save();

        $pegawai = new Pegawai();
        $pegawai->nama_depan = $request->get('nama_depan');
        $pegawai->nama_belakang = $request->get('nama_belakang');
        $pegawai->id_divisi = $request->divisi;
        $pegawai->id_user = $user->id;
        $tgl_lahir = date("Y-m-d", strtotime($request->tgl_lahir));
        $pegawai->tgl_lahir = $tgl_lahir;
        $pegawai->no_hp = $request->get('no_hp');
        $pegawai->jenis_kelamin = $request->get('jenis_kelamin');
        $pegawai->alamat = $request->get('alamat');
        $pegawai->jum_cuti = 12;
        $pegawai->id_desa = $request->desa;
        $pegawai->id_kecamatan = $request->kecamatan;
        $pegawai->id_kota = $request->kota;
        $pegawai->id_provinsi = $request->provinsi;
        $pegawai->save();

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pegawai = Pegawai::find($id);
        return view('pegawai.detail', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = Pegawai::with('user', 'province', 'regency', 'district', 'village', 'divisi')->where('id', $id)->first();
        $divisi = Divisi::where('nama_divisi', '!=', 'Direktur')->get();
        return view('pegawai.edit', compact('pegawai', 'divisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'divisi' => 'required',
            'email' => 'required',
            'tgl_lahir' => 'required',
            'no_hp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);

        $pegawai = Pegawai::find($id);
        $user = User::find($pegawai->id_user);

        $user->name = $request->get('nama_depan') . " " . $request->get('nama_belakang');
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        $pegawai->nama_depan = $request->get('nama_depan');
        $pegawai->nama_belakang = $request->get('nama_belakang');
        $pegawai->id_divisi = $request->divisi;
        $tgl_lahir = date("Y-m-d", strtotime($request->tgl_lahir));
        $pegawai->tgl_lahir = $tgl_lahir;
        $pegawai->no_hp = $request->get('no_hp');
        $pegawai->jenis_kelamin = $request->get('jenis_kelamin');
        $pegawai->alamat = $request->get('alamat');
        $pegawai->id_desa = $request->desa;
        $pegawai->id_kecamatan = $request->kecamatan;
        $pegawai->id_kota = $request->kota;
        $pegawai->id_provinsi = $request->provinsi;
        $pegawai->save();

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
        return redirect()->route('pegawai.index')
            ->with('success');
    }

    public function getProvinsi(Request $request)
    {
        $provinsi = Province::select('id', 'name')
            ->where('name', 'like', '%' . $request->input('search', '') . '%')->get();
        $data = [];
        foreach ($provinsi as $p) {
            $data[] = [
                'id' => $p->id,
                'text' => $p->name
            ];
        }
        return response()->json(['results' => $data]);
    }

    public function getKota($id)
    {
        $data = Regency::where('province_id', '=', $id)->get();
        return response()->json($data, 200);
    }

    public function getKecamatan($id)
    {
        $data = District::where('regency_id', '=', $id)->get();
        return response()->json($data, 200);
    }

    public function getDesa($id)
    {
        $data = Village::where('district_id', '=', $id)->get();
        return response()->json($data, 200);
    }

    public function cities(Request $request)
    {
        $cities = Regency::where([
            ['province_id', '=', $request->id],
            ['name', 'like', '%' . $request->input('search', '') . '%']
        ])->get();

        $data = [];
        foreach ($cities as $city) {
            $data[] = [
                'id' => $city->id,
                'text' => $city->name,
            ];
        }
        return response()->json(['results' => $data]);
    }

    public function districts(Request $request)
    {
        $districts = District::where([
            ['regency_id', '=', $request->id],
            ['name', 'like', '%' . $request->input('search', '') . '%']
        ])->get();

        $data = [];
        foreach ($districts as $district) {
            $data[] = [
                'id' => $district->id,
                'text' => $district->name,
            ];
        }
        return response()->json(['results' => $data]);
    }

    public function villages(Request $request)
    {
        $villages = Village::where([
            ['district_id', '=', $request->id],
            ['name', 'like', '%' . $request->input('search', '') . '%']
        ])->get();

        $data = [];
        foreach ($villages as $village) {
            $data[] = [
                'id' => $village->id,
                'text' => $village->name,
            ];
        }
        return response()->json(['results' => $data]);
    }

    public function pj_sementara(Request $request)
    {
        $pj = Pegawai::where('nama_depan', 'like', '%' . $request->input('search', '') . '%')
            ->orWhere('nama_belakang', 'like', '%' . $request->input('search', '') . '%')->get();

        $data = [];
        foreach ($pj as $pegawai) {
            if ($pegawai->id_divisi != 1) {
                $nama = $pegawai->nama_depan . " " . $pegawai->nama_belakang . " (" . $pegawai->divisi->nama_divisi . ")";
                $data[] = [
                    'id' => $nama,
                    'text' => $nama,
                ];
            }
        }
        return response()->json(['results' => $data]);
    }

    public function listPegawai(Request $request)
    {
        $pegawai = Pegawai::where('nama_depan', 'like', '%' . $request->input('search', '') . '%')
            ->orWhere('nama_belakang', 'like', '%' . $request->input('search', '') . '%')->get();

        $data = [];
        foreach ($pegawai as $p) {
            $nama = $p->nama_depan . " " . $p->nama_belakang . " (" . $p->divisi->nama_divisi . ")";
            $data[] = [
                'id' => $p->id,
                'text' => $nama,
            ];
        }

        $data[] = [
            'id' => 0,
            'text' => 'Semua Pegawai',
        ];
        return response()->json(['results' => $data]);
    }

    public function importExcel()
    {
        $array = (new AbsenImport)->toArray(storage_path('app/public/fauziah.xlsx'));
        $data = $array[0];
        $coba = array();
        for ($i=5; $i < 36; $i++) { 
            if($data[$i][0]!=null){
                if($data[$i][11] == ""){
                    array_push($coba, "-");
                } else {
                    array_push($coba, $data[$i][11]);
                }
            }
        }

        return response()->json([
            'data' => $coba,
            'jumlah' => count($coba)
        ]);
    }
}
