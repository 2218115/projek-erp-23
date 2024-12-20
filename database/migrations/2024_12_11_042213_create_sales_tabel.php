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
        Schema::create('payment_terms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->string('invoice_address');
            $table->string('company_address');
            $table->dateTime('expired_date');
            $table->unsignedBigInteger('id_term');
            $table->double('total_tanpa_pajak');
            $table->double('total_pajak');
            $table->double('total_dengan_pajak');
            $table->timestamps();
        });

        Scema::create('sales_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produk');
            $table->string('deskripsi');
            $table->integer('kuantitas');
            $table->double('harga_satuan');
            $table->double('pajak');
            $table->double('sub_total');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_tabel');
    }
};
