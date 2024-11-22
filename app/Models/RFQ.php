<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RFQ extends Model
{
    use HasFactory;

    protected $table = 'rfq';

    protected $fillable = [
        'id_vendor',
        'id_status',
        'referensi_vendor',
        'tanggal_pesan',
        'total_tanpa_pajak',
        'total_pajak',
        'grand_total',
    ];

    public function vendor(): HasOne
    {
        return $this->hasOne(Vendor::class, 'id', 'id_vendor');
    }

    public function rfq_detail(): HasMany
    {
        return $this->hasMany(RFQDetail::class, 'id_rfq', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(RFQStatus::class, 'id_status', 'id');
    }
}
