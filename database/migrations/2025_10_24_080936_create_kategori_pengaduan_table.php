<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_pengaduan', function (Blueprint $table) {
            $table->id('kategori_id');
            $table->string('nama', 100);
            $table->integer('sla_hari');
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_pengaduan');
    }
};
