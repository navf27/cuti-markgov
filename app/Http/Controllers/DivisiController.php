<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Route::is('divisi.trash')){
            $divisi = Divisi::onlyTrashed()->get();
        } else {
            $divisi = Divisi::all();
        }
        
        return view('divisi.index', compact('divisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('divisi.create');
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
            'nama_divisi' => 'required',
            'nama_kepala' => 'required',
            'ttd' => 'file|image|mimes:jpeg,png,jpg',
        ]);


        if ($request->hasFile('ttd')) {
            $file = $request->file('ttd');
            $image_name = '/images/' . $file->getclientoriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'images';
            $file->move($tujuan_upload, $image_name);
        } else
            $image_name = "";

        $divisi = new Divisi();
        $divisi->nama_divisi = $request->get('nama_divisi');
        $divisi->nama_kepala = $request->get('nama_kepala');
        $divisi->ttd = $image_name;
        $divisi->save();

        return redirect()->route('divisi.index')
            ->with('success', 'Berhasil tambah divisi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $divisi = Divisi::find($id);
        return view('divisi.detail', compact('divisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divisi = Divisi::find($id);
        return view('divisi.edit', compact('divisi'));
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
            'nama_divisi' => 'required',
            'nama_kepala' => 'required',
        ]);

        $divisi = Divisi::find($id);

        // if ($request->select == 'hapus') {
        //     File::delete(public_path($divisi->ttd));
        //     $divisi->ttd = null;
        // } else {
        if ($request->file('ttd') != null) {
            File::delete(public_path($divisi->ttd));
            $file = $request->file('ttd');
            $image_name = '/images/' . $file->getclientoriginalName();
            $divisi->ttd = $image_name;
            $tujuan_upload = 'images';
            $file->move($tujuan_upload, $image_name);
        }
        // }

        $divisi->nama_divisi = $request->get('nama_divisi');
        $divisi->nama_kepala = $request->get('nama_kepala');
        $divisi->save();

        return redirect()->route('divisi.index')
            ->with('success', 'Berhasil update divisi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $divisi = Divisi::find($id);
        if(count($divisi->pegawai) > 0){
            return response()->json([
                'status' => '500',
                'message' => "Gagal menghapus divisi, divisi telah digunakan pada tabel pegawai",
            ], 500);
        }
        
        $divisi->delete();
        return response()->json([
            'status' => '200',
            'message' => "divisi berhasil dihapus",
        ], 200);
    }

    public function restore($id)
    {
        $divisi = Divisi::onlyTrashed()->find($id);
        $divisi->restore();
        return response()->json([
            'status' => '200',
            'message' => "divisi berhasil direstore",
        ], 200);
    }

    public function destroyPermanent($id)
    {
        $divisi = Divisi::onlyTrashed()->find($id);
        File::delete(public_path($divisi->ttd));
        $divisi->forceDelete();
        return response()->json([
            'status' => '200',
            'message' => "divisi berhasil dihapus permanen",
        ], 200);
    }
}
