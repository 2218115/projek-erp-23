<?php

namespace App\Livewire;

use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\Province;

class VendorForm extends Component
{
    public $vendor_id;

    public $kota_search = '';
    public $kota_list;

    public $provinsi_search = '';
    public $provinsi_list;

    public $nama_perusahaan;
    public $kontak_penghubung;
    public $provinsi;
    public $kota;
    public $jalan;
    public $nomor_telepon;
    public $nomor_telepon_mobile;
    public $email;

    protected $rules = [
        'nama_perusahaan' => 'required',
        'kontak_penghubung' => 'required',
        'provinsi' => 'required',
        'kota' => 'required',
        'jalan' => 'required',
        'nomor_telepon' => 'required',
        'nomor_telepon_mobile' => 'required',
        'email' => 'email|required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->vendor_id) {
            $vendor = Vendor::find($this->vendor_id);
            $vendor->nama = $validated['nama_perusahaan'];
            $vendor->kontak_penghubung = $validated['kontak_penghubung'];
            $vendor->provinsi = $validated['provinsi'];
            $vendor->kota = $validated['kota'];
            $vendor->jalan = $validated['jalan'];
            $vendor->nomor_telepon = $validated['nomor_telepon'];
            $vendor->email = $validated['email'];
            $vendor->save();
        } else {

            Vendor::create([
                'nama' => $validated['nama_perusahaan'],
                'kontak_penghubung' => $validated['kontak_penghubung'],
                'provinsi' => $validated['provinsi'],
                'kota' => $validated['kota'],
                'jalan' => $validated['jalan'],
                'nomor_telepon' => $validated['nomor_telepon'],
                'nomor_telepon_mobile' => $validated['nomor_telepon_mobile'],
                'email' => $validated['email'],
            ]);
        }

        return redirect('/vendor');
    }

    public function mount($vendor_id)
    {
        $this->vendor_id = $vendor_id;

        $this->provinsi_list = Province::all();

        if ($this->vendor_id) {
            $vendor = Vendor::find($this->vendor_id);
            if (!$vendor) {
                abort(404, 'Tidak di temukan vendor');
            }

            $this->kota_search = $vendor->r_kota->name;
            $this->provinsi_search = $vendor->r_provinsi->name;
            $this->nama_perusahaan = $vendor->nama;
            $this->kontak_penghubung = $vendor->kontak_penghubung;
            $this->provinsi = $vendor->provinsi;
            $this->kota = $vendor->kota;
            $this->jalan = $vendor->jalan;
            $this->nomor_telepon = $vendor->nomor_telepon;
            $this->nomor_telepon_mobile = $vendor->nomor_telepon_mobile;
            $this->email = $vendor->email;
        }
    }

    public function render()
    {
        return view('livewire.vendor-form', [
            'provinsi_list' => $this->provinsi_list,
            'kota_list' => $this->kota_list,
        ]);
    }

    public function load_kota()
    {
        if (!$this->kota_search == '') {
            $this->kota_list = DB::table('cities')
                ->where('province_code', '=', $this->provinsi)
                ->where('name', 'like', '%' . $this->kota_search . '%')
                ->get();
        } else {
            $this->kota_list = DB::table('cities')
                ->where('province_code', '=', $this->provinsi)
                ->get();
        }
    }

    public function load_provinsi()
    {
        if (!$this->provinsi_search == '') {
            $this->provinsi_list = DB::table('provinces')
                ->where('name', 'like', '%' . $this->provinsi_search . '%')
                ->get();;
        } else {
            $this->provinsi_list = Province::all();
        }
    }
}
