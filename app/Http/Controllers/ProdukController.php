<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $list_produk = collect([
            (object)[
                'id' => 1,
                'gambar' => 'produk-1.jpg', // Example image file name
                'nama_produk' => 'Laptop Lenovo ThinkPad',
                'harga_jual' => 12999.99, // Double value for price
                'deskripsi' => 'Laptop dengan prosesor Intel Core i7, RAM 16GB, dan SSD 512GB.',
            ],
            (object)[
                'id' => 2,
                'gambar' => 'produk-2.jpg',
                'nama_produk' => 'Smartphone Samsung Galaxy S23',
                'harga_jual' => 9999.00,
                'deskripsi' => 'Smartphone flagship Samsung dengan kamera 108MP dan layar AMOLED 6.8 inci.',
            ],
            (object)[
                'id' => 3,
                'gambar' => 'produk-3.jpg',
                'nama_produk' => 'Kulkas Samsung 2 Pintu',
                'harga_jual' => 3500.75,
                'deskripsi' => 'Kulkas 2 pintu dengan kapasitas 500L, hemat energi, dan desain modern.',
            ],
            (object)[
                'id' => 4,
                'gambar' => 'produk-4.jpg',
                'nama_produk' => 'Kamera Sony Alpha A7 III',
                'harga_jual' => 23999.50,
                'deskripsi' => 'Kamera mirrorless dengan sensor full-frame 24.2MP dan kemampuan video 4K.',
            ],
        ]);


        return view('produk.index', [
            'list_produk' => $list_produk,
        ]);
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
        $produk = (object)[
            'id' => $produk_id,
            'nama_produk' => 'Dummy Product',
            'kategori_produk' => 'Electronics',
            'ukuran' => 'Medium',
            'model' => '2024X',
            'garansi' => '2 Years',
            'referensi_internal' => 'REF123',
            'barcode' => '1234567890',
            'gambar' => 'dummy-product.jpg',  // You can set a sample image path here
            'deskripsi' => 'This is a dummy product used for testing purposes.',
            'pajak' => 10.5,
            'harga_jual' => 1500000,  // Price in double format
        ];

        return view('produk.edit', compact('produk'));
    }

    public function show(Request $request, $produk_id)
    {

        $produk = (object)[
            'id' => $produk_id,
            'nama_produk' => 'Dummy Product',
            'kategori_produk' => 'Electronics',
            'ukuran' => 'Medium',
            'model' => '2024X',
            'garansi' => '2 Years',
            'referensi_internal' => 'REF123',
            'barcode' => '1234567890',
            'gambar' => 'dummy-product.jpg',  // You can set a sample image path here
            'deskripsi' => 'This is a dummy product used for testing purposes.',
            'pajak' => 10.5,
            'harga_jual' => 1500000,  // Price in double format
        ];

        return view('produk.detail', compact('produk'));
    }
}
