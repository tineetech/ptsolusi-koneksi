<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('judul');
            $table->string('kategori');
            $table->date('tanggal');
            $table->string('penulis');
            $table->string('gambar');
            $table->text('ringkas');
            $table->longText('isi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};
