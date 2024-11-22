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
        Schema::create('bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->unsignedBigInteger('id_ukuran')->nullable();
            $table->string('model');
            $table->string('referensi_internal');
            $table->string('barcode');
            $table->string('gambar');
            $table->text('deskripsi')->nullable();
            $table->double('pajak');
            $table->double('harga_beli');
            $table->double('stock')->default(0);
            $table->timestamps();

            $table->foreign('id_kategori')->references('id')->on('kategori_produk');
            $table->foreign('id_ukuran')->references('id')->on('ukuran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_baku');
    }
};
