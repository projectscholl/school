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
        'payment_links'
    ];

}
