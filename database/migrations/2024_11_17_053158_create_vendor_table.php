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
        Schema::create('vendor', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kontak_penghubung');
            $table->unsignedBigInteger('provinsi');
            $table->unsignedBigInteger('kota');
            $table->string('jalan');
            $table->string('nomor_telepon');
            $table->string('nomor_telepon_mobile');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor');
    }
};
