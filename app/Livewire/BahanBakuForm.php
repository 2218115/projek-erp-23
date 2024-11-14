<?php

namespace App\Livewire;

use App\Models\KategoriProduk;
use App\Models\BahanBaku;
use App\Models\UkuranProduk;
use Livewire\Component;
use Livewire\WithFileUploads;

class BahanBakuForm extends Component
{
    use WithFileUploads;

    public $bahan_baku_id;


    public $nama;
    public $kategori;
    public $ukuran;
    public $model;
    public $referensi_internal;
    public $barcode;
    public $gambar;
    public $deskripsi;
    public $pajak;
    public $harga_beli;

    protected $rules = [
        'nama' => 'min:6|required',
        'kategori' => 'nullable',
        'ukuran' => 'nullable',
        'model' => 'required',
        'referensi_internal' => 'required',
        'barcode' => 'required',
        'gambar' => 'required',
        'deskripsi' => 'nullable',
        'pajak' => 'required|numeric',
        'harga_beli' => 'required|numeric',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validated = $this->validate();

        if (!$this->bahan_baku_id) {
            // Menyimpan file gambar
            $lokasi = $this->gambar->store('gambar_bahan_baku', 'public');
            $nama_file = basename($lokasi);

            // Membuat entri baru bahan baku
            BahanBaku::create([
                "nama" => $validated["nama"],
                "id_kategori" => $validated["kategori"] ?? null,
                "id_ukuran" => $validated["ukuran"],
                "model" => $validated["model"],
                "referensi_internal" => $validated["referensi_internal"],
                "barcode" => $validated["barcode"],
                "gambar" => $nama_file,
                "deskripsi" => $validated["deskripsi"],
                "pajak" => $validated["pajak"],
                "harga_beli" => $validated["harga_beli"],
            ]);
        } else {
            $bahanBaku = BahanBaku::find($this->bahan_baku_id);

            // Update gambar jika diperbarui
            if (!is_string($this->gambar)) {
                $lokasi = $this->gambar->store('gambar_bahan_baku', 'public');
                $nama_file = basename($lokasi);
                $bahanBaku->gambar = $nama_file;
            }

            // Update data bahan baku
            $bahanBaku->nama = $this->nama;
            $bahanBaku->id_kategori = $this->kategori;
            $bahanBaku->id_ukuran = $this->ukuran;
            $bahanBaku->model = $this->model;
            $bahanBaku->referensi_internal = $this->referensi_internal;
            $bahanBaku->barcode = $this->barcode;
            $bahanBaku->deskripsi = $this->deskripsi;
            $bahanBaku->pajak = $this->pajak;
            $bahanBaku->harga_beli = $this->harga_beli;

            $bahanBaku->save();
        }

        return redirect('/bahan-baku');
    }

    public function mount()
    {
        if ($this->bahan_baku_id) {
            $bahanBaku = BahanBaku::find($this->bahan_baku_id);
            if (!$bahanBaku) {
                abort(404, 'Bahan baku tidak ditemukan');
            }

            $this->nama = $bahanBaku->nama;
            $this->kategori = $bahanBaku->kategori->id ?? null;
            $this->ukuran = $bahanBaku->ukuran->id ?? null;
            $this->model = $bahanBaku->model;
            $this->referensi_internal = $bahanBaku->referensi_internal;
            $this->barcode = $bahanBaku->barcode;
            $this->gambar = $bahanBaku->gambar;
            $this->deskripsi = $bahanBaku->deskripsi;
            $this->pajak = $bahanBaku->pajak;
            $this->harga_beli = $bahanBaku->harga_beli;
        }
    }

    public function render()
    {
        $kategori_list = KategoriProduk::all();
        $ukuran_list = UkuranProduk::all();

        return view('livewire.bahan-baku-form', [
            "kategori_list" => $kategori_list,
            "ukuran_list" => $ukuran_list,
        ]);
    }
}
