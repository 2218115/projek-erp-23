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
        Schema::create('rfq_status', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('rfq', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_vendor');
            $table->string('id_status', 50);

            $table->string('referensi_vendor')->nullable();
            $table->dateTime('tanggal_pesan');
            $table->double('total_tanpa_pajak');
            $table->double('total_pajak');
            $table->double('grand_total');
            $table->timestamps();

            $table->foreign('id_vendor')->references('id')->on('vendor');
            $table->foreign('id_status')->references('id')->on('rfq_status');
        });

        Schema::create('rfq_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rfq');
            $table->unsignedBigInteger('id_bahan_baku');
            $table->string('deskripsi');
            $table->double('kuantitas');
            $table->double('harga_satuan');
            $table->double('pajak');
            $table->double('subtotal');
            $table->double('diterima');
            $table->double('dibayar');
            $table->timestamps();

            $table->foreign('id_rfq')->references('id')->on('rfq');
            $table->foreign('id_bahan_baku')->references('id')->on('bahan_baku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rfq');
        Schema::dropIfExists('rfq_detail');
        Schema::dropIfExists('rfq_status');
    }
};
