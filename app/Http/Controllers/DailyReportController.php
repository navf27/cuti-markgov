<?php

namespace App\Http\Controllers;

use App\Models\Daily;
use App\Models\User;
use Illuminate\Http\Request;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DailyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = Daily::where('id_user', $user->id)->orderBy('tanggal', 'desc')->paginate(10);
        return view('daily.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('daily.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tempat' => 'required',
            'aktivitas' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_akhir' => 'required',
            'nama_dinas' => 'nullable',
            'no_cp' => 'nullable',

        ],[
            'tempat.required' => 'Tempat Kegiatan tidak boleh kosong!',
            'aktivitas.required' => 'Aktivitas Kegiatan tidak boleh kosong!',
            'tanggal.required' => 'Tanggal Kegiatan tidak boleh kosong!',
            'jam_mulai.required' => 'Jam mulai Kegiatan tidak boleh kosong!',
            'jam_akhir.required' => 'Jam akhir Kegiatan tidak boleh kosong!',

        ]);

        // dd($request->all());
        DB::beginTransaction();
        try {
            
            Daily::create([
                'tempat' => $validated['tempat'],
                'aktivitas' => $validated['aktivitas'],
                'tanggal' => $validated['tanggal'],
                'jam_mulai' => $validated['jam_mulai'],
                'jam_akhir' => $validated['jam_akhir'],
                'no_cp' => $validated['no_cp'],
                'nama_dinas' => $validated['nama_dinas'],
                'id_user' => Auth::user()->id,
            ]);
            
            DB::commit();

            return redirect()->route('daily.index')->with('success', "Berhasil menambah");

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('danger', $th->getMessage());
        }
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
        $data = Daily::find($id);
        return view('daily.edit', compact('data'));
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
        // dd($request->all());
        DB::beginTransaction();
        try {
            
            $daily = Daily::find($id);
            
            if ($request->tempat) {
                $daily->tempat = $request->tempat;
            }

            if ($request->aktivitas) {
                $daily->aktivitas = $request->aktivitas;
            }

            if ($request->tanggal) {
                $daily->tanggal = $request->tanggal;
            }

            if ($request->jam_mulai) {
                $daily->jam_mulai = $request->jam_mulai;
            }

            if ($request->jam_akhir) {
                $daily->jam_akhir = $request->jam_akhir;
            }

            if ($request->no_cp) {
                $daily->no_cp = $request->no_cp;
            }

            if ($request->nama_dinas) {
                $daily->nama_dinas = $request->nama_dinas;
            }

            $daily->save();
            
            DB::commit();

            return redirect()->route('daily.index')->with('success', "Berhasil mengedit data");

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('danger', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            
            $daily = Daily::find($id);
            $daily->delete();
            
            DB::commit();

            return redirect()->back()->with('success', "Berhasil menghapus data");

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('danger', $th->getMessage());
        }
    }

    public function seacrhDaily($request, $data)
    {
        if ($request->nama != "") {
            $data = $data->Orwhere('id_user', '=', $request->nama);
        }

        if ($request->tempat != "") {
            $data = $data->Orwhere('tempat', 'LIKE', '%'.$request->tempat.'%');
        }

        if ($request->tanggal_awal != "" && $request->tanggal_akhir != "") {
            $data = $data->where('tanggal', ">=", $request->tanggal_awal)
            ->whereDate('tanggal', "<=", $request->tanggal_akhir);
        }

        return $data;
    }

    public function DailyReport(Request $request)
    {
        $user = User::all();
        $data = Daily::with('user')->orderBy('tanggal', 'desc');

        if ($request->all() != null) {
            // dd($request->all());
            $data = $this->seacrhDaily($request,$data);
        }
        $data = $data->paginate(10);

       return view('daily.report', compact('data','user'));
    }
}
