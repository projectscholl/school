<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Angkatan extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'tahun'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->logOnlyDirty();
    }
    public function murids()
    {
        return $this->belongsTo(Murid::class, 'id_angkatans');
    }

    public function biaya()
    {
        return $this->hasOne(Biaya::class, 'id_angkatans');
    }

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
