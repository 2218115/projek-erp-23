<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOStatus extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $table = 'status_mo';

    protected $fillable = [
        'nama',
        'badge_classname',
    ];
}
