<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk;

class SalesForm extends Component
{

    public $customers;
    public $produk_list;
    
    /**
     * produk
     * nama_produk
     * deskripsi
     * kuantitas
     * harga_satuan
     * pajak
     * subtotal
     */
    
    public $sales_detail_list;
    public $total_pajak;
    public $total_tanpa_pajak;
    public $grand_total;

    protected $listeners = ['sales_item_change' => 'sales_item_change'];


    public function mount() {
        $this->customers = collect([
            (object)[ 'id' => 1, 'name' => 'PT. ABC', 'email' => 'contact@abc.com', 'phone' => '081234567890', 'address' => 'Jl. ABC No. 1, Jakarta' ],
            (object)[ 'id' => 2, 'name' => 'CV. XYZ', 'email' => 'info@xyz.com', 'phone' => '082345678901', 'address' => 'Jl. XYZ No. 2, Bandung' ],
            (object)[ 'id' => 3, 'name' => 'PT. MNO', 'email' => 'contact@mno.com', 'phone' => '083456789012', 'address' => 'Jl. MNO No. 3, Surabaya' ],
            (object)[ 'id' => 4, 'name' => 'CV. PQR', 'email' => 'support@pqr.com', 'phone' => '084567890123', 'address' => 'Jl. PQR No. 4, Medan' ],
            (object)[ 'id' => 5, 'name' => 'PT. TUV', 'email' => 'hello@tuv.com', 'phone' => '085678901234', 'address' => 'Jl. TUV No. 5, Makassar' ],
        ]);

        $this->produk_list = Produk::all();
        $this->sales_detail_list = [];
    }

    public function do_customers_load() {

    }

    public function render()
    {
        return view('livewire.sales-form');
    }

    public function do_produk_load($query)
    {
        if ($query === '') {
            $this->produk_list = Produk::all();
        } else {
            $this->produk_list = Produk::where('nama', 'like', '%' . $query . '%')->get();
        }
    }

    public function on_sales_item_produk_change($index, $new_produk_id)
    {
        if (!isset($this->sales_detail_list[$index])) {
            return;
        }

        $old_produk = $this->sales_detail_list[$index]['produk'];
        $is_change = $old_produk != $new_produk_id;

        if ($is_change) {
            $new_produk = Produk::find($new_produk_id);
            $this->sales_detail_list[$index]['nama_produk'] = $new_produk->nama;
            $this->sales_detail_list[$index]['produk'] = $new_produk->id;
            $this->sales_detail_list[$index]['deskripsi'] = $new_produk->deskripsi;
            $this->sales_detail_list[$index]['kuantitas'] = 1;
            $this->sales_detail_list[$index]['harga_satuan'] = $new_produk->harga_jual;
            $this->sales_detail_list[$index]['pajak'] = $new_produk->pajak;
            $this->sales_detail_list[$index]['subtotal'] = $new_produk->harga_jual * 1;

            $this->dispatch('sales_item_change');
        }
    }

    public function sales_item_change()
    {
        $grand_total = 0;
        $total_pajak = 0;
        $total_biaya_tanpa_pajak = 0;

        foreach ($this->sales_detail_list as $index => $sales_item) {
            $this->sales_detail_list[$index]['subtotal'] = is_numeric($sales_item['harga_satuan']) && is_numeric($sales_item['kuantitas']) ? $sales_item['harga_satuan'] *  $sales_item['kuantitas'] : 0;
            $total_pajak += is_numeric($sales_item['subtotal']) && is_numeric($sales_item['pajak']) ? $sales_item['subtotal'] *  ($sales_item['pajak'] / 100.0) : 0;

            $total_biaya_tanpa_pajak += $this->sales_detail_list[$index]['subtotal'];
        }

        $grand_total += $total_pajak + $total_biaya_tanpa_pajak;

        $this->total_pajak = $total_pajak;
        $this->total_tanpa_pajak = $total_biaya_tanpa_pajak;
        $this->grand_total = $grand_total;
    }

    public function tambah_sales_item() {
        $this->sales_detail_list[] = [
            'produk' => '',
            'nama_produk' => '',
            'deskripsi' => '',
            'kuantitas' => 1,
            'harga_satuan' => '',
            'pajak' => '',
            'subtotal' => 0,
        ];
    }


    public function hapus_sales_item($index)
    {
        if (!isset($this->sales_detail_list[$index])) {
            return;
        }

        unset($this->sales_detail_list[$index]);
        $this->sales_detail_list = array_values($this->sales_detail_list);

        $this->dispatch('sales_item_change');
    }

    public function on_sales_item_deskripsi_change($index, $new_value)
    {
        $this->sales_detail_list[$index]['deskripsi'] = $new_value;
    }

    public function on_sales_item_kuantitas_change($index, $new_value)
    {
        $this->sales_detail_list[$index]['kuantitas'] = is_numeric($new_value) ? $new_value : 0;

        $this->dispatch('sales_item_change');
    }

    public function  on_sales_item_harga_satuan_change($index, $new_value)
    {
        if (!$this->sales_detail_list[$index]['harga_satuan']) {
            return;
        }

        $this->sales_detail_list[$index]['harga_satuan'] = $new_value;
        $this->dispatch('sales_item_change');
    }

    public function  on_sales_item_pajak_change($index, $new_value)
    {
        if (!$this->sales_detail_list[$index]['pajak']) {
            return;
        }

        $this->sales_detail_list[$index]['pajak'] = $new_value;
        $this->dispatch('sales_item_change');
    }
}
