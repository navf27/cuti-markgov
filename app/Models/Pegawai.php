<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';
    protected $fillable = [
        'id_user',
        'id_divisi',
        'nama_depan',
        'nama_belakang',
        'tgl_lahir',
        'no_hp',
        'jenis_kelamin',
        'alamat',
        'jum_cuti',
        'id_desa',
        'id_kecamatan',
        'id_kota',
        'id_provinsi',
    ];

    public function village()
    {
        return $this->belongsTo(Village::class, 'id_desa', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'id_kecamatan', 'id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'id_kota', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'id_provinsi', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id');
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'id_pegawai', 'id');
    }

    public function getNamaPegawaiAttribute()
    {
        return $this->nama_depan . " " . $this->nama_belakang;
    }
}
