<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Murid extends Model
{
    use HasFactory;
    use LogsActivity;



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->logOnlyDirty();
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'id_users')->where('role', 'WALI');
    }
    public function ayahs()
    {
        return $this->belongsTo(Orangtua::class, 'id_ayah')->where('sebagai', 'Ayah');
    }
    public function ibus()
    {
        return $this->belongsTo(Orangtua::class, 'id_ibu')->where('sebagai', 'Ibu');
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

    public function biayas()
    {
        return $this->hasMany(Biaya::class, 'id_angkatans', 'id_angkatans')
            ->where('id_jurusans', $this->id_jurusans)
            ->where('id_kelas', $this->id_kelas);
    }

    public function tagihanDetail()
    {
        return $this->hasMany(TagihanDetail::class, 'id_murids');
    }
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'id_users');
    }


    protected $fillable = [
        'id_users',
        'id_ayah',
        'id_ibu',
        'name',
        'nisn',
        'tanggal_lahir',
        'agama',
        'jenis_kelamin',
        'id_jurusans',
        'id_kelas',
        'id_angkatans',
        'address',
    ];
}
