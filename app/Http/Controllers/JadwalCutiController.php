<?php

namespace App\Http\Controllers;

use App\Models\JadwalCuti;
use App\Traits\CutiTraits;
use Illuminate\Http\Request;

class JadwalCutiController extends Controller
{
    use CutiTraits;
    
    public function __construct()
    {
        $this->middleware('auth');
        $cutiBersama = JadwalCuti::where('tipe', JadwalCuti::CUTI_BERSAMA)->get();
        foreach ($cutiBersama as $cuti_bersama) {
            $tgl_akhir = date('Y-m-d', strtotime('+1 day', strtotime($cuti_bersama->tgl_akhir)));
            if(now() >= $cuti_bersama->tgl_awal && now() <= $tgl_akhir){
                $this->addCutiBersama($cuti_bersama);
            }
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = JadwalCuti::all();
        return view('jadwalCuti.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jadwalCuti.create');
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
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'keterangan' => 'required',
            'tipe' => 'required',
        ]);

        $jadwal = new JadwalCuti();
        $jadwal->keterangan = $request->keterangan;
        $jadwal->tgl_awal = $request->tgl_awal;
        $jadwal->tgl_akhir = $request->tgl_akhir;
        $jadwal->tipe = $request->tipe;
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwal = JadwalCuti::find($id);
        return view('jadwalCuti.edit', compact('jadwal'));
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
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'keterangan' => 'required',
            'tipe' => 'required',
        ]);

        $jadwal = JadwalCuti::find($id);
        $jadwal->keterangan = $request->keterangan;
        $jadwal->tgl_awal = $request->tgl_awal;
        $jadwal->tgl_akhir = $request->tgl_akhir;
        $jadwal->tipe = $request->tipe;
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = JadwalCuti::find($id);
        if(count($jadwal->cuti) > 0){
            return response()->json([
                'status' => '500',
                'message' => "Gagal menghapus jadwal cuti atau libur nasional, data telah digunakan pada tabel cuti",
            ], 500);
        }
        $jadwal->delete();
        return response()->json([
            'status' => '200',
            'message' => "data berhasil dihapus",
        ], 200);
    }
}
