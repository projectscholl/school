<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Biaya extends Model
{
    use HasFactory;
    use LogsActivity;


    protected $fillable = [
        'id_angkatans',
        'id_kelas',
        'id_jurusans',
        'nama_biaya',
        'jenis_biaya',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->logOnlyDirty();
    }
    public function angkatans()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatans');
    }
    public function jurusans()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusans');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function murids()
    {
        return $this->hasMany(Murid::class, 'id_angkatans', 'id_angkatans')
            ->where('id_jurusans', $this->id_jurusans)
            ->where('id_kelas', $this->id_kelas);
    }



    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'id_biayas');
    }
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}
