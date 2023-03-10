<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Masyarakat extends Authenticatable
{
    use HasFactory;

    protected $table = 'masyarakat';
    protected $guard = 'masyarakat';
    protected $fillable = [
        'nik',
        'name',
        'username',
        'password',
        'tlpn',
    ];

    protected $hidden = [];
    public function pengaduan(){
        return $this->hasMany(Pengaduan::class, 'id_masyarakat');
    }
}