<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Divisi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_divisi',
        'nama_kepala',
        'ttd',
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_divisi', 'id');
    }
}
