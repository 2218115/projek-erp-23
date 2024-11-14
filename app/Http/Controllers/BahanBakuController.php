<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    public function index()
    {
        return view('bahan-baku.index');
    }

    public function create()
    {
        return view('bahan-baku.tambah');
    }

    public function edit($bahan_baku_id)
    {
        return view('bahan-baku.edit', compact('bahan_baku_id'));
    }

    public function show($bahan_baku_id)
    {
        $bahan_baku = BahanBaku::find($bahan_baku_id);
        return view('bahan-baku.detail', compact('bahan_baku'));
    }

    public function destroy($bahan_baku_id)
    {
        dd($bahan_baku_id);
    }
}