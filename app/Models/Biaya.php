<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Biaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_angkatans',
        'id_kelas',
        'id_jurusans',
        'nama_biaya',
        'jenis_biaya',
    ];

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
    public function murids()
    {
        return $this->belongsTo(Murid::class, 'id_angkatans', 'id_angkatans')
            ->where('id_jurusans', $this->id_jurusans)
            ->where('id_kelas', $this->id_kelas);
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class,'id_biayas');
    }
}
