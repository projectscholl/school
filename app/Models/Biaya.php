<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'id_angkatans',
        'total_biaya',
    ];

    public function angkatans()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatans');
    }
}
