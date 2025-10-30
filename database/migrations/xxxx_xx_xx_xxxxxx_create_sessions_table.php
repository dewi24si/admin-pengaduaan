<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID unik session
            $table->foreignId('user_id')->nullable()->index(); // ID user (jika login)
            $table->string('ip_address', 45)->nullable(); // IP pengguna
            $table->text('user_agent')->nullable(); // Browser user
            $table->longText('payload'); // Data session tersimpan
            $table->integer('last_activity')->index(); // Waktu terakhir aktivitas
        });
    }

    /**
     * Hapus tabel jika rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
