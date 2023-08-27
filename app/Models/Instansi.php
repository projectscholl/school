<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'name',
        'telepon',
        'email',
        'alamat',
        'tanda_tangan'
    ];

    
}
