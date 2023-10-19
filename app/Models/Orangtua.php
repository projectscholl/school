<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orangtua extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'status',
        'sebagai',
        'telepon',
        'agama',
        'pekerjaan',
        'pendidikan',
        'alamat',
        'image'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
