<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_biayas',
        'start_date',
        'end_date',
        'amount',
        'status',
    ];

    
    public function biayas()
    {
        return $this->belongsTo(Biaya::class, 'id_biayas');
    }
    public function detailTagihan()
    {
        return $this->hasMany(TagihanDetail::class);
    }
}
