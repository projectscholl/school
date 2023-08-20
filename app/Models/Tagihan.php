<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_angkatans',
        'id_user',
        'start_date',
        'end_date',
    ];

    public function angkatans()
    {
        return $this->hasMany(Angkatan::class, 'id_angkatans');
    }
    public function detailTagihan()
    {
        return $this->hasMany(TagihanDetail::class);
    }
}
