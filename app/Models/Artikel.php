<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';

    protected $fillable = [
        'slug',
        'judul',
        'kategori',
        'tanggal',
        'penulis',
        'gambar',
        'ringkas',
        'isi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function tanggalFormatted(): Attribute
    {
        return Attribute::get(fn () => $this->formatTanggal());
    }

    private function formatTanggal(): ?string
    {
        if (! $this->tanggal) {
            return null;
        }

        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];

        return $this->tanggal->format('j').' '.$bulan[(int) $this->tanggal->format('n')].' '.$this->tanggal->format('Y');
    }
}
