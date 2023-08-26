<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_angkatans',
        'id_jurusans',
        'kelas',
    ];

    public function angkatans()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatans');
    }
    public function jurusans()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusans');
    }
}
