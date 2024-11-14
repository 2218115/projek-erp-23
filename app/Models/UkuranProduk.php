<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkuranProduk extends Model
{
    use HasFactory;

    protected $table = "ukuran";

    protected $fillable = [
        "nama",
    ];
}
