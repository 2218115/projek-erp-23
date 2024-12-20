<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function r_provinsi()
    {
        return $this->belongsTo(Province::class, 'provinsi');
    }

    public function r_kota()
    {
        return $this->belongsTo(City::class, 'kota');
    }
}
