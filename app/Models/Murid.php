<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    use HasFactory;



    public function User()
    {
        return $this->belongsTo(User::class, 'id_users')->where('role', 'WALI');
    }

    public function angkatans()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatans');
    }

    public function jurusans()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusans');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function biayas()
    {
        return $this->hasMany(Biaya::class, 'id_angkatans', 'id_jurusans', 'id_kelas');
    }

    public function tagihanDetail()
    {
        return $this->hasMany(TagihanDetail::class, 'id_murids');
    }
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'id_users');
    }


    protected $fillable = [
        'id_users',
        'name',
        'nisn',
        'id_jurusans',
        'id_kelas',
        'id_angkatans',
        'address',
    ];
}
