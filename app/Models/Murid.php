<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    use HasFactory;
    

    
    public function User()
    {
        return $this->belongsTo(User::class, 'id_users')->where('role', 'WALI');
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatans');
    }

    protected $fillable = [
        'id_users',
        'name',
        'nisn',
        'jurusan',
        'kelas',
        'id_angkatans',
        'biaya_id'
    ];


}
