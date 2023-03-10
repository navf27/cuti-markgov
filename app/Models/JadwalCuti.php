<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalCuti extends Model
{
    use HasFactory;

    const CUTI_BERSAMA = 1;
    const LIBUR_NASIONAL = 2;

    protected $table = 'jadwal_cutis';
    protected $fillable = [
        'keterangan',
        'tgl_awal',
        'tgl_akhir',
        'tipe',
    ];

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'id_jadwal_cuti', 'id');
    }
}
