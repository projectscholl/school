<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_angkatans',
        'nama'
    ];

    public function angkatans()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatans');
    }
}
