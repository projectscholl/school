<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_murid',
        'nama_biaya',
        'nama_murid',
        'desc',
        'total_biaya',
        'id_user',
        'start_date',
        'end_date',
    ];

    public function murids()
    {
        return $this->hasMany(Murid::class, 'id_murid');
    }
    public function biaya()
    {
        return $this->belongsTo(BIaya::class, 'id_biayas');
    }
    public function detailTagihan()
    {
        return $this->hasMany(TagihanDetail::class);
    }
}
