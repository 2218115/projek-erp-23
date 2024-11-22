<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BahanBaku extends Model
{
    use HasFactory;

    protected $table = "bahan_baku";

    protected $fillable = [
        "nama",
        "id_kategori",
        "id_ukuran",
        "model",
        "referensi_internal",
        "barcode",
        "gambar",
        "deskripsi",
        "pajak",
        "harga_beli",
        "stock",
    ];

    public function kategori_produk(): HasOne
    {
        return $this->hasOne(KategoriProduk::class, "id", "id_kategori");
    }

    public function ukuran(): HasOne
    {
        return $this->hasOne(UkuranProduk::class, "id", "id_ukuran");
    }
}
