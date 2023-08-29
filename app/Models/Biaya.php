<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function murids()
    {
        return $this->belongsTo(Murid::class, 'id_biayas');
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }
}
