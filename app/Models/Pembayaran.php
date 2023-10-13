<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
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
    public function wali()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
    public function murids()
    {
        return $this->belongsTo(Murid::class, 'id_users');
    }
    public function tagihanDetails()
    {
        return $this->hasMany(TagihanDetail::class, 'id_pembayarans');
    }
    public function getPaymentTypeAttribute()
    {
        if ($this->payment_links == 'Cash') {
            return 'Cash';
        } elseif ($this->payment_links == NULL) {
            return 'Bank';
        } else {
            return 'Pembayaran Online';
        }
    }
}
