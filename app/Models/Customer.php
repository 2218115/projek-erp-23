<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\Province;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nama_perusahaan',
        'npwp',
        'nomor_telepon',
        'nomor_telepon_mobile',
        'provinsi',
        'kota',
        'email',
        'jalan',
    ];

    public function r_provinsi(): HasOne
    {
        return $this->hasOne(Province::class, 'code', 'provinsi');
    }

    public function r_kota(): HasOne
    {
        return $this->hasOne(City::class, 'code', 'kota');
    }
}
