<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Tagihan extends Model
{
    use HasFactory;
    use LogsActivity;


    protected $fillable = [
        'id_biayas',
        'start_date',
        'end_date',
        'mounth',
        'amount',
        'status',
    ];

    public function biayas()
    {
        return $this->belongsTo(Biaya::class, 'id_biayas');
    }
    public function detailTagihan()
    {
        return $this->hasMany(TagihanDetail::class, 'id_tagihan');
    }
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'id_tagihans');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->logOnlyDirty();
    }
}
