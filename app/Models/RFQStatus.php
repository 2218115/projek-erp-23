<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RFQStatus extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $table = 'rfq_status';

    protected $guarded = [];
}
