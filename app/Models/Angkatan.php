<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun'
    ];

    public function murids()
    {
        return $this->belongsTo(Murid::class, 'id_angkatans');
    }
    
    public function biaya()
    {
        return $this->hasOne(Biaya::class, 'id_angkatans');
        return $this->belongsTo(Murid::class);
    }
}

