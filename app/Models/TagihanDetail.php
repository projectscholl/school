<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tagihan',
        'nama_biaya',
        'jumlah_biaya',
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan');
    }
}
