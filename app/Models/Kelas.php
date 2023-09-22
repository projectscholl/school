<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Kelas extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'id_angkatans',
        'id_jurusans',
        'kelas',
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
}
