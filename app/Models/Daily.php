<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    use HasFactory;
    public $table = 'daily_report';
    protected $guarded = ['id'];
    protected $dates = ['tanggal','jam_mulai', 'jam_akhir'];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
