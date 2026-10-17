<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'tanggal',
        'gambar',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

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
