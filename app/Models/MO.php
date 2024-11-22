<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MO extends Model
{
    use HasFactory;

    protected $table = "mo";

    protected $fillable = [
        'id_status',
        'id_produk',
        'id_bom',
        'kuantitas',
        'tanggal_produksi',
    ];

    public function bom(): BelongsTo
    {
        return $this->belongsTo(Bom::class, 'id_bom', 'id');
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(MOStatus::class, 'id_status', 'id');
    }

    public function mo_detail(): HasMany
    {
        return $this->hasMany(MODetail::class, 'id_mo', 'id');
    }
}
