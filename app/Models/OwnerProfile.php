<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerProfile extends Model
{
    protected $fillable = [
        'nama_kost',
        'nama_pemilik',
        'alamat',
        'no_telepon',
        'email',
        'logo_path',
    ];
}
