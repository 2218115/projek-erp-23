<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\BomDetail;

class BomController extends Controller
{
    public function index()
    {
        // dd(Bom::with('produk')->with('bahan_baku')->get());

        return view('bom.index');
    }

    public function create()
    {
        return view('bom.tambah');
    }
}
