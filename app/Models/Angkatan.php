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
        return $this->hasMany(Murid::class, 'id_angkatans');
    }
}
