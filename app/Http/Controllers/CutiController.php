<?php

namespace App\Http\Controllers;

use App\Mail\AccEmail;
use App\Mail\EmailPegawai;
use App\Models\Cuti;
use App\Models\Divisi;
use App\Models\Pegawai;
use App\Models\User;
use App\Traits\CutiTraits;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CutiController extends Controller
{
    use CutiTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $pegawai = Pegawai::where('id_user', $user->id)->first();
        $cuti = Cuti::where('id_pegawai', $pegawai->id)->orderBy('id', 'desc')->get();
        return view('cuti.index', compact('cuti'));
    }

    public function indexAdmin()
    {
        $cuti = Cuti::where('kategori', '!=', Cuti::RESET_CUTI)->orderBy('status', 'asc')->orderBy('id', 'desc')->get();
        return view('cuti.index_admin', compact('cuti'));
    }

    public function indexKepala()
    {
        $user = Auth::user();
        $pegawai = Pegawai::where('id_user', $user->id)->first();
        $id_pegawai = Pegawai::where('id_divisi', $pegawai->id_divisi)->pluck('id')->toArray();
        if ($user->id != 7) {
            $cuti = Cuti::where('kategori', '!=', Cuti::RESET_CUTI)->whereIn('id_pegawai', $id_pegawai)->orderBy('id', 'desc')->orderBy('status', 'asc')->get();
        } else {
            $cuti = Cuti::where([['acc_kepala', 1], ['kategori', '!=', Cuti::RESET_CUTI]])->orderBy('status', 'asc')->orderBy('id', 'desc')->get();
        }

        return view('cuti.index_admin', compact('cuti'));
    }

    public function updateStatus(Request $request)
    {
        $cuti = Cuti::find($request->id);
        $pegawai = Pegawai::find($cuti->id_pegawai);

        if (Auth::user()->id == 7) {
            $jumlah_cuti = $this->countCutiDays($cuti->tgl_awal_cuti, $cuti->tgl_akhir_cuti);
            if ($cuti->status == Cuti::PENGAJUAN || $cuti->status == Cuti::DITOLAK) {
                if ($request->status == Cuti::DITERIMA) {
                    if ($pegawai->jum_cuti > $jumlah_cuti) {
                        $pegawai->jum_cuti -= $jumlah_cuti;
                    } else {
                        return response()->json([
                            'status' => '500',
                            'message' => "Cuti tidak dapat diterima karena kuota cuti kurang",
                        ], 500);
                    }
                }
            } else {
                if ($request->status == Cuti::DITOLAK) {
                    $pegawai->jum_cuti += $jumlah_cuti;
                }
            }

            if ($cuti->kategori == Cuti::CUTI_TAHUNAN) {
                $pegawai->save();
            }
            if ($cuti->kategori == Cuti::CUTI_SAKIT) {
                // $pegawai->save();
                dd($cuti);
            }
            $cuti->status = $request->status;
            $cuti->save();

            // kirim email notifikasi ke pegawai
            Mail::to($pegawai->user->email)->send(new EmailPegawai($cuti));
        } else {
            $cuti->acc_kepala = $request->status;
            $cuti->save();

            // kirim email notifikasi ke direktur
            if ($cuti->acc_kepala == Cuti::KEPALA_SUDAH) {
                $direktur = Pegawai::find(7);
                $cuti->user_acc_id = $direktur->user->id;
                $cuti->email = $direktur->user->email;
                $cuti->type_email = 1;
                Mail::to($direktur->user->email)->send(new AccEmail($cuti));
            } else {
                $cuti->status = Cuti::DITOLAK;
                $cuti->save();
                Mail::to($pegawai->user->email)->send(new EmailPegawai($cuti));
            }
        }

        // kirim email notifikasi feedback
        $cuti->type_email = 2;
        Mail::to(Auth::user()->email)->send(new AccEmail($cuti));

        return response()->json([
            'status' => '200',
            'message' => "Berhasil update status cuti",
        ], 200);
    }

    public function updateStatusEmail(Request $request)
    {
        $cuti = Cuti::find($request->id);
        $pegawai = Pegawai::find($cuti->id_pegawai);

        if ($request->user_acc_id == 7) {
            if ($cuti->status != Cuti::PENGAJUAN) {
                return redirect()->route('errorEmail');
            }
            $jumlah_cuti = $this->countCutiDays($cuti->tgl_awal_cuti, $cuti->tgl_akhir_cuti);
            if ($cuti->status == Cuti::PENGAJUAN || $cuti->status == Cuti::DITOLAK) {
                if ($request->status == Cuti::DITERIMA) {
                    if ($pegawai->jum_cuti > $jumlah_cuti) {
                        $pegawai->jum_cuti -= $jumlah_cuti;
                    } else {
                        return response()->json([
                            'status' => '500',
                            'message' => "Cuti tidak dapat diterima karena kuota cuti kurang",
                        ], 500);
                    }
                }
            } else {
                if ($request->status == Cuti::DITOLAK) {
                    $pegawai->jum_cuti += $jumlah_cuti;
                }
            }

            if ($cuti->kategori == Cuti::CUTI_TAHUNAN) {
                $pegawai->save();
            }
            $cuti->status = $request->status;
            $cuti->save();

            // kirim email notifikasi ke pegawai
            Mail::to($pegawai->user->email)->send(new EmailPegawai($cuti));
        } else {
            if ($cuti->acc_kepala != Cuti::KEPALA_BELUM) {
                return redirect()->route('errorEmail');
            }
            $cuti->acc_kepala = $request->status;
            $cuti->save();

            // kirim email notifikasi ke direktur
            if ($cuti->acc_kepala == Cuti::KEPALA_SUDAH) {
                $direktur = Pegawai::find(7);
                $cuti->user_acc_id = $direktur->user->id;
                $cuti->email = $direktur->user->email;
                $cuti->type_email = 1;
                Mail::to($direktur->user->email)->send(new AccEmail($cuti));
            } else {
                $cuti->status = Cuti::DITOLAK;
                $cuti->save();
                Mail::to($pegawai->user->email)->send(new EmailPegawai($cuti));
            }
        }

        // kirim email notifikasi feedback
        $cuti->type_email = 2;
        Mail::to($request->email)->send(new AccEmail($cuti));

        return redirect()->away('https://mail.google.com/mail/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $pegawai = Pegawai::where('id_user', $user->id)->first();
        $divisi = Divisi::find($pegawai->id_divisi);
        $direktur = User::find(7);
        return view('cuti.create', compact('divisi', 'direktur'));
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
            'tgl_awal_cuti' => 'required|date',
            'tgl_akhir_cuti' => 'required|date',
            'keterangan' => 'required',
            'menyetujui' => 'required',
        ]);

        $user = $request->user();
        $pegawai = Pegawai::where('id_user', $user->id)->first();
        $direktur = User::find(7);

        if ($request->kategori == Cuti::CUTI_TAHUNAN) {
            $tgl_sekarang = strtotime(now());
            $bulan = date("m", $tgl_sekarang);
            $tahun = date("Y", $tgl_sekarang);

            $data_cuti = Cuti::where([
                ['id_pegawai', $pegawai->id],
                ['kategori', Cuti::CUTI_TAHUNAN]
            ])->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get();
            if ($data_cuti) {
                if (count($data_cuti) >= 2) {
                    return redirect()->route('cuti.create')->withErrors('Tidak dapat mengajukan cuti lebih dari 2 kali dalam sebulan');
                }
            }
        }

        if ($pegawai->jum_cuti == 0) {
            if ($request->file('surat_pendukung') == null || $request->kategori == '1') {
                return redirect()->route('cuti.create')->withErrors('Tidak dapat mengajukan cuti karena slot cuti anda telah habis');
            }
        }

        $cuti = new Cuti();
        $cuti->tgl_awal_cuti = $request->get('tgl_awal_cuti');
        $cuti->tgl_akhir_cuti = $request->get('tgl_akhir_cuti');
        $cuti->id_pegawai = $pegawai->id;
        $cuti->keterangan = $request->get('keterangan');
        $cuti->sisa_cuti  = $pegawai->jum_cuti;
        if ($pegawai->id == 7) {
            $cuti->acc_kepala = 1;
        }

        // jika cuti sakit cuti otomatis diterima
        if ($request->kategori == Cuti::CUTI_SAKIT) {
            $cuti->status = Cuti::PENGAJUAN;
            $cuti->acc_kepala = Cuti::KEPALA_BELUM;
            if ($request->file('surat_pendukung') == null) {
                $jumlah_cuti = $this->countCutiDays($request->get('tgl_awal_cuti'), $request->get('tgl_akhir_cuti'));
                if ($pegawai->jum_cuti > $jumlah_cuti) {
                    $pegawai->jum_cuti -= $jumlah_cuti;
                    $pegawai->save();
                }
            }
        } else {
            $cuti->status = Cuti::DITERIMA;
        }


        $cuti->kategori = $request->kategori;
        if ($request->file('surat_pendukung')) {
            $cuti->surat_pendukung = $this->getPathFile($request->file('surat_pendukung'), 'surat');
        }
        $cuti->pj_sementara = $request->pj ?? null;
        $cuti->no_surat     = $this->generateNoSurat();
        $cuti->mengetahui   = $direktur->name;
        $cuti->menyetujui   = $request->get('menyetujui');
        $cuti->created_by   = $user->id;
        $cuti->save();

        // kirim email notifikasi ke kepala divisi
        if ($request->kategori != Cuti::CUTI_SAKIT) {
            $kepala = Pegawai::where('id_divisi', $pegawai->id_divisi)->whereHas('user', function ($query) {
                $query->where('role', '2');
            })->first();

            $cuti->user_acc_id = $kepala->user->id;
            $cuti->email = $kepala->user->email;
            $cuti->type_email = 1;
            Mail::to($kepala->user->email)->send(new AccEmail($cuti));
        }

        return redirect()->route('cuti.index')
            ->with('success', 'Berhasil mengajukan cuti');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuti = Cuti::find($id);
        return view('cuti.detail', compact('cuti'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuti = Cuti::find($id);
        $user = Auth::user();
        $pegawai = Pegawai::where('id_user', $user->id)->first();
        $divisi = Divisi::find($pegawai->id_divisi);
        $direktur = User::find(7);
        return view('cuti.edit', compact('cuti', 'divisi', 'direktur'));
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
            'tgl_awal_cuti' => 'required|date',
            'tgl_akhir_cuti' => 'required|date',
            'keterangan' => 'required',
            'menyetujui' => 'required',
        ]);

        $direktur = User::find(7);
        $cuti = Cuti::find($id);
        $cuti->tgl_awal_cuti = $request->get('tgl_awal_cuti');
        $cuti->tgl_akhir_cuti = $request->get('tgl_akhir_cuti');
        $cuti->keterangan = $request->get('keterangan');
        $cuti->status = Cuti::PENGAJUAN;
        $cuti->mengetahui = $direktur->name;
        $cuti->menyetujui = $request->get('menyetujui');
        $cuti->pj_sementara = $request->pj;
        if ($request->file('surat_pendukung')) {
            Storage::delete('public/' . $cuti->surat_pendukung);
            $cuti->surat_pendukung = $this->getPathFile($request->file('surat_pendukung'), 'Surat');
        }
        $cuti->save();

        if ($request->previous_url == url('/cuti')) {
            return redirect()->route('cuti.index')
                ->with('success', 'Berhasil update cuti');
        } elseif (Auth::user()->role == "1") {
            return redirect()->route('cuti.admin.index')
                ->with('success', 'Berhasil update cuti');
        } elseif (Auth::user()->role == "2") {
            return redirect()->route('cuti.kepala.index')
                ->with('success', 'Berhasil update cuti');
        } else {
            return redirect()->route('cuti.index')
                ->with('success', 'Berhasil update cuti');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cuti = Cuti::find($request->id);
        if ($cuti->status == Cuti::DITERIMA) {
            $pegawai = Pegawai::find($cuti->id_pegawai);
            $jumlah_cuti = $this->countCutiDays($cuti->tgl_awal_cuti, $cuti->tgl_akhir_cuti);
            $pegawai->jum_cuti += $jumlah_cuti;
            $pegawai->save();
        }
        if ($cuti->surat_pendukung) {
            Storage::delete('public/' . $cuti->surat_pendukung);
        }
        $cuti->delete();
        return redirect()->route('cuti.index')
            ->with('success', 'Berhasil menghapus data cuti');
    }

    public function cetakPengajuan($id)
    {
        $pengajuan = Cuti::find($id);
        $pengajuan->lama_cuti = $this->countCutiDays($pengajuan->tgl_awal_cuti, $pengajuan->tgl_akhir_cuti);
        $pengajuan->sisa_cuti_min = $pengajuan->kategori == 1 || $pengajuan->kategori == null ? $pengajuan->sisa_cuti - $pengajuan->lama_cuti : $pengajuan->sisa_cuti;
        $tgl_dibuat = strtotime($pengajuan->created_at);
        $pengajuan->tgl_dibuat = Carbon::parse($tgl_dibuat)->locale('id')->isoFormat('D MMMM Y');

        $pengaju = $pengajuan->pegawai->nama_pegawai . ", " . $pengajuan->pegawai->divisi->nama_divisi;
        $kepala = $pengajuan->pegawai->divisi->nama_kepala . ", Manajer " . $pengajuan->pegawai->divisi->nama_divisi;
        $direktur = config('app.nama_direktur') . ", Direktur Scomptec";
        $pengajuan->qr_pengaju = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($pengaju));
        $pengajuan->qr_kepala = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($kepala));
        $pengajuan->qr_direktur = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($direktur));
        $nama_file = "Pengajuan_cuti_" . $pengajuan->pegawai->nama_depan . "_" . $pengajuan->pegawai->nama_belakang . ".pdf";
        $pdf = Pdf::loadView('cuti.pengajuan_pdf', compact('pengajuan'));
        return $pdf->download($nama_file);
        // return view('cuti.pengajuan_pdf', compact('pengajuan'));
    }
    //baru ditambah
    public function cetakPengajuanSakit($id)
    {
        $pengajuansakit = Cuti::find($id);
        $pengajuansakit->lama_cuti = $this->countCutiDays($pengajuansakit->tgl_awal_cuti, $pengajuansakit->tgl_akhir_cuti);
        $pengajuansakit->sisa_cuti_min = $pengajuansakit->kategori == 1 || $pengajuansakit->kategori == null ? $pengajuansakit->sisa_cuti->lama_cuti : $pengajuansakit->sisa_cuti;
        $tgl_dibuat = strtotime($pengajuansakit->created_at);
        $pengajuansakit->tgl_dibuat = Carbon::parse($tgl_dibuat)->locale('id')->isoFormat('D MMMM Y');

        $pengaju = $pengajuansakit->pegawai->nama_pegawai . ", " . $pengajuansakit->pegawai->divisi->nama_divisi;
        $kepala = $pengajuansakit->pegawai->divisi->nama_kepala . ", Manajer " . $pengajuansakit->pegawai->divisi->nama_divisi;
        $direktur = config('app.nama_direktur') . ", Direktur Scomptec";
        $pengajuansakit->qr_pengaju = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($pengaju));
        $pengajuansakit->qr_kepala = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($kepala));
        $pengajuansakit->qr_direktur = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($direktur));
        $nama_file = "Pengajuan_cuti_sakit_" . $pengajuansakit->pegawai->nama_depan . "_" . $pengajuansakit->pegawai->nama_belakang . ".pdf";
        $pdf = Pdf::loadView('cuti.pengajuansakit_pdf', compact('pengajuansakit'));
        return $pdf->download($nama_file);
        // return view('cuti.pengajuansakit_pdf', compact('pengajuan'));
    }

    public function createFingerprint()
    {
        return view('cuti.fingerprint');
    }

    public function storeFingerPrint(Request $request)
    {
        $pegawai                = Pegawai::find($request->pegawai);
        $direktur               = User::find(7);
        $cuti                   = new Cuti();
        $cuti->tgl_awal_cuti    = $request->get('tgl_awal_cuti');
        $cuti->tgl_akhir_cuti   = $request->get('tgl_akhir_cuti');
        $cuti->id_pegawai       = $pegawai->id;
        $cuti->keterangan       = "Tidak melakukan fingerprint";
        $cuti->sisa_cuti        = $pegawai->jum_cuti;
        $cuti->acc_kepala       = 1;
        $cuti->status           = Cuti::DITERIMA;
        $cuti->mengetahui       = $direktur->name;
        $cuti->menyetujui       = $pegawai->divisi->nama_kepala;
        $cuti->created_by       = Auth::user()->id;
        $jumlah_cuti            = $this->countCutiDays($request->get('tgl_awal_cuti'), $request->get('tgl_akhir_cuti'));
        if ($pegawai->jum_cuti > $jumlah_cuti) {
            $pegawai->jum_cuti -= $jumlah_cuti;
        } else {
            $pegawai->jum_cuti = 0;
        }
        $pegawai->save();
        $cuti->save();

        return redirect()->route('cuti.admin.index')
            ->with('success', 'Berhasil menyimpan data');
    }
}
