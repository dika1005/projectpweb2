<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama sepatu
            $table->text('description')->nullable(); // Deskripsi sepatu
            $table->decimal('price', 10, 2); // Harga
            $table->string('size'); // Ukuran (bisa string biar fleksibel: 39, 40, M, L, dll)
            $table->integer('stock'); // Jumlah stok
            $table->string('image')->nullable(); // Path gambar sepatu
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
