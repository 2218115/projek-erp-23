<?php

namespace App\Livewire;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Vermaysha\Wilayah\Models\Province;

class CustomerForm extends Component
{
    public $kota;
    public $kota_list;
    public $kota_search;

    public $provinsi;
    public $provinsi_list;
    public $provinsi_search;

    public $customer_id = null;

    public $nama_customer;
    public $nama_perusahaan;
    public $jalan;
    public $npwp;
    public $nomor_telepon;
    public $nomor_telepon_mobile;
    public $email;

    protected $rules = [
        'nama_customer' => 'required',
        'nama_perusahaan' => 'required',
        'npwp' => 'nullable',
        'nomor_telepon' => 'required',
        'nomor_telepon_mobile' => 'required',
        'provinsi' => 'required',
        'kota' => 'required',
        'email' => 'required',
        'jalan' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.customer-form');
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
                ->get();
        } else {
            $this->provinsi_list = Province::all();
        }
    }

    public function mount($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    public function save()
    {
        if ($this->customer_id) {
            $this->update_customer();
        } else {
            $this->create_customer();
        }
    }

    public function create_customer()
    {
        $validated = $this->validate();

        Customer::create([
            'nama' => $validated['nama_customer'],
            'nama_perusahaan' => $validated['nama_perusahaan'],
            'npwp' => $validated['npwp'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'provinsi' => $validated['provinsi'],
            'kota' => $validated['kota'],
            'email' => $validated['email'],
            'jalan' => $validated['jalan'],
        ]);


        return redirect('/customer');
    }

    public function update_customer()
    {
        $id = $this->customer_id;
        $validated = $this->validate();

        $customer = Customer::find($id);
        $customer->update([
            'nama' => $validated['nama_customer'],
            'nama_perusahaan' => $validated['nama_perusahaan'],
            'npwp' => $validated['npwp'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'provinsi' => $validated['provinsi'],
            'kota' => $validated['kota'],
            'email' => $validated['email'],
            'jalan' => $validated['jalan'],
        ]);

        return redirect('/customer');
    }
}
