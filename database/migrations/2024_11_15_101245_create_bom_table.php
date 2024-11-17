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
        Schema::create('bom', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->double('kuantitas');
            $table->string('referensi_internal');
            $table->unsignedBigInteger('id_produk');
            $table->double('grand_total');
            $table->timestamps();

            $table->foreign('id_produk')->references('id')->on('produk');
        });

        Schema::create('bom_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bom');
            $table->unsignedBigInteger('id_bahan_baku');
            $table->double('kuantitas');
            $table->double('harga_asli');
            $table->double('harga_bom');
            $table->timestamps();

            $table->foreign('id_bom')->references('id')->on('bom');
            $table->foreign('id_bahan_baku')->references('id')->on('bahan_baku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bom');
    }
};
