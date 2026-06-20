<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('kode_pesanan')->unique(); 
            $table->enum('jenis_layanan', ['Reguler', 'Express']); 
            $table->text('item_khusus')->nullable(); 
            $table->decimal('berat', 5, 2); 
            $table->decimal('total_harga', 10, 2);
            $table->enum('status_cucian', ['Cuci', 'Setrika', 'Selesai', 'Sudah Diambil', 'Tidak Diambil'])->default('Cuci'); 
            $table->dateTime('tenggat_waktu'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};