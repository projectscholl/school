<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pembayarans',
        'id_tagihan',
        'nama_biaya',
        'id_murids',
        'status',
        'start_date',
        'end_date',
        'jumlah_biaya',
    ];
    public function murids()
    {
        return $this->belongsTo(Murid::class, 'id_murids');
    }
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan');
    }
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayarans');
    }
}
