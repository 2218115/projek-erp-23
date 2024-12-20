<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\UkuranProduk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk.index');
    }

    public function create()
    {
        return view('produk.tambah');
    }

    public function store()
    {
        return view('produk.tambah');
    }

    public function edit(Request $request, $produk_id)
    {
        return view('produk.edit', compact('produk_id'));
    }

    public function show(Request $request, $produk_id)
    {

        $produk = Produk::find($produk_id);

        return view('produk.detail', compact('produk'));
    }

    public function destroy(Request $request, $produk_id)
    {
        Produk::destroy($produk_id);

        return redirect('/produk');
    }

    public function report()
    {
        $produk = Produk::with(['kategori_produk', 'ukuran'])->get();
        $pdf = Pdf::loadView('produk.report', [
            'produk' => $produk,
        ]);
        return $pdf->download('produk.pdf');
    }
}
