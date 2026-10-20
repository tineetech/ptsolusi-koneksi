<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesan_kontak', function (Blueprint $table) {
            $table->enum('status', ['pending', 'replied'])->default('pending')->after('pesan');
        });
    }

    public function down(): void
    {
        Schema::table('pesan_kontak', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
