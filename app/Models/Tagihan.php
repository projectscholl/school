<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_biayas',
        'start_date',
        'end_date',
        'mounth',
        'amount',
        'status',
    ];

    public function murids()
    {
        return $this->hasMany(Murid::class, 'id_murid');
    }
    public function biayas()
    {
        return $this->belongsTo(Biaya::class, 'id_biayas');
    }
    public function detailTagihan()
    {
        return $this->hasMany(TagihanDetail::class);
    }
}
