<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\BomDetail;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function show($bom_id)
    {
        $bom = Bom::find($bom_id);

        return view('bom.detail', compact('bom'));
    }

    public function edit($bom_id)
    {
        return view('bom.edit', compact('bom_id'));
    }

    public function report()
    {
        $bom = Bom::all();
        $pdf = Pdf::loadView('bom.report', [
            'bom' => $bom,
        ]);
        return $pdf->download('bom-list.pdf');
    }
}
