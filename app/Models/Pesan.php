<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
        'dibaca'
    ];

    protected $casts = [
        'dibaca' => 'boolean',
        'created_at' => 'datetime',
    ];
}
