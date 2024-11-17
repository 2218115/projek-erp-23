<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bom extends Model
{
    use HasFactory;

    protected $table = "bom";

    protected $fillable = [
        "nama",
        "kuantitas",
        "referensi_internal",
        "id_produk",
        "grand_total",
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, "id_produk", "id");
    }

    public function bom_detail(): HasMany
    {
        return $this->hasMany(BomDetail::class, "id_bom", "id");
    }

    public function bahan_baku(): BelongsToMany
    {
        return $this->belongsToMany(BahanBaku::class, "bom_detail", "id_bom", "id_bahan_baku");
    }
}
