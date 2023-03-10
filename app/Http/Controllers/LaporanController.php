<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Pegawai;
use App\Traits\CutiTraits;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    use CutiTraits;

    public function indexLaporan()
    {
        return view('laporan.index');
    }

    public function getDataLaporan(Request $request)
    {
        try {
            $cuti = Cuti::where([
                ['status', '1'],
                ['tgl_awal_cuti', '>=', $request->tgl_awal],
                ['tgl_akhir_cuti', '<=', $request->tgl_akhir]
            ])->when($request->kategori != '0', function ($query) use ($request) {
                $query->where('kategori', $request->kategori);
            })->when($request->pegawai != '0', function ($query) use ($request) {
                $query->where('id_pegawai', $request->pegawai);
            })->get();

            foreach ($cuti as $c) {
                $c->jumlah_cuti = $this->countCutiDays($c->tgl_awal_cuti, $c->tgl_akhir_cuti);
                $c->nama = $c->nama_pegawai;
                $c->jenis_cuti = $c->kategori_cuti;
                $c->no_surat = $c->no_surat ? $c->no_surat : '-';
                $c->nama = $c->pegawai->nama_pegawai;
                $c->tgl_surat = Carbon::createFromFormat('Y-m-d H:i:s', $c->created_at)->format('Y-m-d');
            }
            return response()->json([$cuti], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 'Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function showPengajuan($id)
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

        $pdf = Pdf::loadView('cuti.pengajuan_pdf', compact('pengajuan'));
        return $pdf->stream();
        // return view('cuti.pengajuan_pdf', compact('pengajuan'));
    }

    public function showLaporanPegawai($id_pegawai)
    {
        $pegawai = Pegawai::find($id_pegawai);
        return view('laporan.show', compact('pegawai'));
    }

    public function getLaporanPegawai(Request $request)
    {
        try {
            $cuti = Cuti::where([
                ['status', '1'], ['id_pegawai', $request->id_pegawai],
                ['tgl_awal_cuti', '>=', $request->tgl_awal],
                ['tgl_akhir_cuti', '<=', $request->tgl_akhir]
            ])->get();

            foreach ($cuti as $value) {
                $value->nama_kategori = $value->kategori_cuti;
                $value->jumlah_cuti = $value->lama_cuti;
            }

            return response()->json([$cuti], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 'Error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function cetakLaporan(Request $request)
    {
        $laporan = Cuti::where([
            ['status', '1'],
            ['tgl_awal_cuti', '>=', $request->tgl_awal],
            ['tgl_akhir_cuti', '<=', $request->tgl_akhir]
        ])->when($request->kategori != '0', function ($query) use ($request) {
            $query->where('kategori', $request->kategori);
        })->when($request->pegawai != '0', function ($query) use ($request) {
            $query->where('id_pegawai', $request->pegawai);
        })->get();

        foreach ($laporan as $l) {
            $l->tgl_surat = Carbon::createFromFormat('Y-m-d H:i:s', $l->created_at)->format('Y-m-d');
            $l->no_surat = $l->no_surat ? $l->no_surat : '-';
        }

        $tanggal = [$request->tgl_awal, $request->tgl_akhir];
        $nama_file = "Rekap_cuti_pegawai_" . $request->tgl_awal . "_" . $request->tgl_akhir . ".pdf";
        $pdf = Pdf::loadView('laporan.laporan_pegawai_pdf', compact('laporan', 'tanggal'));
        return $pdf->download($nama_file);
        // return view('laporan.laporan_pegawai_pdf', compact('pegawai', 'laporan'));

    }
}
