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
        Schema::create('status_mo', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('mo', function (Blueprint $table) {
            $table->id();
            $table->string('id_status', 50);
            $table->unsignedBigInteger('id_produk');
            $table->double('kuantitas');
            $table->dateTime('tanggal_produksi');
            $table->unsignedBigInteger('id_bom');
            $table->timestamps();

            $table->foreign('id_produk')->references('id')->on('produk');
            $table->foreign('id_bom')->references('id')->on('bom');
            $table->foreign('id_status')->references('id')->on('status_mo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mo');
        Schema::dropIfExists('status_mo');
    }
};
