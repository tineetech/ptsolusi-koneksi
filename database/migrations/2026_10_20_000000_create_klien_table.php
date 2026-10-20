<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('klien', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_id')->constrained('produk')->cascadeOnDelete();
            $table->string('nama_client');
            $table->string('nama_perusahaan');
            $table->string('email');
            $table->string('no_telephone', 30);
            $table->text('alamat_perusahaan');
            $table->text('notes')->nullable();
            $table->enum('status', ['proses', 'konsultasi', 'terjual'])->default('proses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('klien');
    }
};
