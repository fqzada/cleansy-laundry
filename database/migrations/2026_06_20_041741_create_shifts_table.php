<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration (Membuat tabel).
     */
    public function up(): void
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamp('waktu_mulai')->useCurrent();
            $table->timestamp('waktu_selesai')->nullable();
            $table->decimal('uang_fisik', 15, 2)->nullable(); // Uang riil di laci
            $table->decimal('selisih', 15, 2)->nullable();    // Selisih akhir
            $table->string('status')->default('aktif');       // 'aktif' atau 'selesai'
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (Menghapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};