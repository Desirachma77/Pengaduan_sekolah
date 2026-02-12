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
        Schema::create('cetak_laporan', function (Blueprint $table) {
            $table->id('id_cetak');
            $table->unsignedBigInteger('id_aspirasi');
            $table->unsignedBigInteger('id_admin');
            $table->enum('jenis_cetak', ['PDF', 'Print']);
            $table->timestamp('waktu_cetak')->useCurrent();

            $table->foreign('id_aspirasi')->references('id_aspirasi')->on('aspirasi')->cascadeOnDelete();
            $table->foreign('id_admin')->references('id_admin')->on('admin')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cetak_laporan');
    }
};
