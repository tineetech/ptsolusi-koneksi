<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    protected $table = 'klien';

    protected $fillable = [
        'layanan_id',
        'nama_client',
        'nama_perusahaan',
        'email',
        'no_telephone',
        'alamat_perusahaan',
        'notes',
        'status',
    ];

    public function layanan()
    {
        return $this->belongsTo(Produk::class, 'layanan_id');
    }
}
