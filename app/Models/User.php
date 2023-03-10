<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ADMIN = '1';
    const KEPALA = '2';
    const PEGAWAI = '3';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pegawai(){
        return $this->hasMany(Pegawai::class, 'id', 'id_pegawai');
    }

    public function cuti(){
        return $this->hasMany(Cuti::class, 'created_by', 'id');
    }

    public function getRoleNameAttribute()
    {
        if($this->role == '1'){
            return 'Admin';
        } else if($this->role == '2'){
            return 'Kepala';
        } else {
            return 'Pegawai';
        }
    }

    public function getAvatarAttribute()
    {
        if($this->photo){
            return $this->photo;
        } else {
            return asset('viho/assets/images/dashboard/1.png');
        }
    }
}
