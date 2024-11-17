<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BomDetail extends Model
{
    use HasFactory;

    protected $table = "bom_detail";

    protected $fillable = [
        "id_bom",
        "id_bahan_baku",
        "kuantitas",
        "harga_asli",
        "harga_bom",
    ];

    public function bom(): BelongsTo
    {
        return $this->belongsTo(Produk::class, "id_bom", "id");
    }

    public function bahan_baku(): HasOne
    {
        return $this->hasOne(BahanBaku::class, "id", "id_bahan_baku");
    }
}
