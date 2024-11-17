<?php

namespace App\Livewire;

use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\UkuranProduk;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProdukForm extends Component
{
    use WithFileUploads;

    public $produk_id;

    public $nama_produk;
    public $kategori_produk;
    public $ukuran;
    public $model;
    public $garansi;
    public $referensi_internal;
    public $barcode;
    public $gambar;
    public $deskripsi;
    public $pajak;
    public $harga_jual;
    public $biaya_produk; // Field baru untuk biaya produk

    protected $rules = [
        'nama_produk' => 'min:6',
        'kategori_produk' => 'required',
        'ukuran' => 'required',
        'model' => 'required',
        'garansi' => 'required',
        'referensi_internal' => 'required',
        'barcode' => 'required',
        'gambar' => 'required',
        'deskripsi' => 'nullable',
        'pajak' => 'required',
        'harga_jual' => 'required',
        'biaya_produk' => 'required', // Tambahkan validasi untuk biaya produk
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validated = $this->validate();

        if (!$this->produk_id) {
            $lokasi = $this->gambar->store('gambar_produk', 'public');
            $nama_file = basename($lokasi);

            Produk::create([
                "nama" => $validated["nama_produk"],
                "id_kategori" => $validated["kategori_produk"],
                "id_ukuran" => $validated["ukuran"],
                "model" => $validated["model"],
                "garansi" => $validated["garansi"],
                "referensi_internal" => $validated["referensi_internal"],
                "barcode" => $validated["barcode"],
                "gambar" => $nama_file,
                "deskripsi" => $validated["deskripsi"],
                "pajak" => $validated["pajak"],
                "harga_jual" => $validated["harga_jual"],
                "biaya_produk" => $validated["biaya_produk"], // Simpan biaya produk
            ]);
        } else {
            $produk = Produk::find($this->produk_id);

            if (!is_string($this->gambar)) {
                $lokasi = $this->gambar->store('gambar_produk', 'public');
                $nama_file = basename($lokasi);
                $produk->gambar = $nama_file;
            }

            $produk->nama = $this->nama_produk;
            $produk->id_kategori = $this->kategori_produk;
            $produk->id_ukuran = $this->ukuran;
            $produk->model = $this->model;
            $produk->garansi = $this->garansi;
            $produk->referensi_internal = $this->referensi_internal;
            $produk->barcode = $this->barcode;
            $produk->deskripsi = $this->deskripsi;
            $produk->pajak = $this->pajak;
            $produk->harga_jual = $this->harga_jual;
            $produk->biaya_produk = $this->biaya_produk; // Update biaya produk

            $produk->save();
        }

        return redirect('/produk');
    }

    public function mount()
    {
        if ($this->produk_id) {
            $produk = Produk::find($this->produk_id);
            if (!$produk) {
                abort(404, 'Produk tidak di temukan');
            }

            $this->nama_produk = $produk->nama;
            $this->kategori_produk = $produk->kategori_produk->id;
            $this->ukuran = $produk->ukuran->id;
            $this->model = $produk->model;
            $this->garansi = $produk->garansi;
            $this->referensi_internal = $produk->referensi_internal;
            $this->barcode = $produk->barcode;
            $this->gambar = $produk->gambar;
            $this->deskripsi = $produk->deskripsi;
            $this->pajak = $produk->pajak;
            $this->harga_jual = $produk->harga_jual;
            $this->biaya_produk = $produk->biaya_produk; // Set biaya produk saat mount
        }
    }

    public function render()
    {
        $kategori_produk_list = KategoriProduk::all();
        $ukuran_produk_list = UkuranProduk::all();

        return view('livewire.produk-form', [
            "kategori_produk_list" => $kategori_produk_list,
            "ukuran_produk_list" => $ukuran_produk_list,
        ]);
    }
}
