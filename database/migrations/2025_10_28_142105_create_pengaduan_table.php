<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('pengaduan_id');
            $table->string('nomor_tiket')->unique();
            $table->unsignedBigInteger('warga_id');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('status')->nullable();
            $table->string('lokasi_text')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->timestamps();

            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('warga')
                ->onDelete('cascade');

            $table->foreign('kategori_id')
                ->references('kategori_id')
                ->on('kategori_pengaduan')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};