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
        Schema::create('mo_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mo');
            $table->unsignedBigInteger('id_bahan_baku');
            $table->double('to_consumed');
            $table->double('reserved');
            $table->string('is_available', 1);
            $table->timestamps();

            $table->foreign('id_bahan_baku')->references('id')->on('bahan_baku');
            $table->foreign('id_mo')->references('id')->on('mo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mo_detail');
    }
};
