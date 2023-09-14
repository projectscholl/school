<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tagihan_details',
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

    public function TagihanDetail()
    {
        return $this->belongsTo(TagihanDetail::class, 'id_tagihan_details');
    }
    public function murids()
    {
        return $this->belongsTo(Murid::class, 'id_users'); 
    }
}
