<?php

namespace App\Models;

use App\Traits\CutiTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cuti extends Model
{
    use HasFactory, CutiTraits;

    // status
    const PENGAJUAN = '0';
    const DITERIMA  = '1';
    const DITOLAK   = '2';

    // validasi
    const Yes  = '1';
    const No   = '2';

    // kategori
    const CUTI_TAHUNAN      = 1;
    const CUTI_SAKIT        = 2;
    const CUTI_DISPENSASI   = 3; 
    const RESET_CUTI        = 4;
    
    // acc kepala
    const KEPALA_BELUM = 0;
    const KEPALA_SUDAH = 1;
    const KEPALA_TOLAK = 2;

    protected $table = 'cutis';
    protected $fillable = [
        'id_pegawai',
        'id_jadwal_cuti',
        'tgl_awal_cuti',
        'tgl_akhir_cuti',
        'keterangan',
        'pj_sementara',
        'no_surat',
        'surat_pendukung'.
        'status',
        'kategori',
        'menyetujui',
        'mengetahui',
        'created_by'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function jadwalCuti()
    {
        return $this->belongsTo(JadwalCuti::class, 'id_jadwal_cuti', 'id');
    }

    public function getFilePathAttribute()
    {
        if ($this->surat_pendukung) {
            return asset($this->surat_pendukung);
        } else {
            return asset('blank.png');
        }
    }

    public function getKategoriCutiAttribute()
    {
        if($this->kategori == 1){
            return "Cuti Tahunan";
        } else if($this->kategori == 2){
            return "Cuti Sakit";
        } else if($this->kategori == 3) {
            return "Cuti Dispensasi";
        } else if($this->kategori == 4){
            return "Reset Cuti Tahunan";
        } else {
            return "-";
        }
    }

    public function getStatusCutiAttribute()
    {
        if($this->status == '0'){
            return "Pengajuan";
        } else if($this->status == '1'){
            return 'Diterima';
        } else if($this->status == '2'){
            return "Ditolak";
        } else {
            return "-";
        }
    }

    public function getStatusKepalaAttribute()
    {
        if($this->acc_kepala == 0){
            return "Belum";
        } else if($this->acc_kepala == 1){
            return 'Sudah';
        } else if($this->acc_kepala == 2){
            return "Ditolak";
        } else {
            return "-";
        }
    }

    public function getLamaCutiAttribute()
    {
        return $this->countCutiDays($this->tgl_awal_cuti, $this->tgl_akhir_cuti);
    }
}
