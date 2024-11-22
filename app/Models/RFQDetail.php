<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RFQDetail extends Model
{
    use HasFactory;

    protected $table = 'rfq_detail';

    protected $fillable = [
        'id_rfq',
        'id_bahan_baku',
        'deskripsi',
        'kuantitas',
        'harga_satuan',
        'pajak',
        'subtotal',
        'diterima',
        'dibayar',
    ];

    public function bahan_baku(): HasOne
    {
        return $this->hasOne(BahanBaku::class, 'id', 'id_bahan_baku');
    }
}
