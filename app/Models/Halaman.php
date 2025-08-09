<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Halaman extends Model
{
    use SoftDeletes;
    
    protected $table = 'halaman';
    
    protected $fillable = [
        'judul', 
        'slug', 
        'konten', 
        'gambar', 
        'jenis', 
        'meta_keyword', 
        'meta_deskripsi',
        'deleted_at'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
