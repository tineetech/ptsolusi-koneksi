<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'slug',
        'nama',
        'kategori',
        'gambar',
        'ringkas',
        'deskripsi',
        'fitur',
    ];

    protected $casts = [
        'fitur' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
