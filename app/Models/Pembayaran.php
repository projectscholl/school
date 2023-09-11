<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tagihans',
        'amount',
        'mounth',
        'id_users',
        'payment_status',
        'payment_links',
        'nama_pengirim',
        'rek_pengirim',
        'bukti_transaksi',
        'total_bayar',
        'identitas_penerima'
    ];

    public function tagihans()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihans');
    }
    public function murids()
    {
        return $this->belongsTo(Murid::class, 'id_users'); 
    }
}
