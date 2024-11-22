<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MODetail extends Model
{
    use HasFactory;

    protected $table = 'mo_detail';

    protected $fillable = [
        'id_mo',
        'id_bahan_baku',
        'to_consumed',
        'reserved',
        'is_available',
    ];


    public function bahan_baku(): BelongsTo
    {
        return $this->belongsTo(BahanBaku::class, 'id_bahan_baku', 'id');
    }

    public function mo(): BelongsTo
    {
        return $this->belongsTo(MO::class, 'id_mo', 'id');
    }
}
