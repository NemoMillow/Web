<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanSitus extends Model
{
    protected $fillable = [
        'nama_site',
        'deskripsi_site',
        'logo',
        'favicon',
        'alamat',
        'telepon',
        'email',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'maps_embed',
    ];
}
