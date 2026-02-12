<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('aspirasi', function (Blueprint $table) {
    $table->id('id_aspirasi');

    // RELASI SISWA (SATU-SATUNYA RELASI SISWA)
    $table->foreignId('siswa_id')
          ->constrained('siswa')
          ->cascadeOnDelete();

    // SNAPSHOT DATA (BUKAN RELASI)
    $table->string('nama_siswa', 255);

    // RELASI LAIN
    $table->unsignedBigInteger('id_kategori');
    $table->unsignedBigInteger('id_admin')->nullable();

    // DATA ASPIRASI
    $table->string('lokasi', 100);
    $table->text('ket_laporan');
    $table->string('foto_bukti')->nullable();

    $table->enum('status', ['Menunggu', 'Diproses', 'Selesai'])
          ->default('Menunggu');

    $table->text('feedback')->nullable();
    $table->timestamps();

    // FOREIGN KEY LAIN
    $table->foreign('id_kategori')
          ->references('id_kategori')
          ->on('kategori')
          ->cascadeOnDelete();

    $table->foreign('id_admin')
          ->references('id_admin')
          ->on('admin')
          ->nullOnDelete();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};
