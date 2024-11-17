<?php

namespace App\Livewire;

use App\Models\BahanBaku;
use App\Models\Bom;
use App\Models\BomDetail;
use App\Models\Produk;
use Livewire\Component;

class BomForm extends Component
{
    public $produk_search;

    protected $queryString = ['produk_search'];

    public $nama_bom;
    public $kuantitas;
    public $produk;
    public $harga_jual;
    public $referensi_internal;
    public $bom_item_list = array();
    public $biaya_produk;

    public $total_biaya;
    public $interval_biaya;

    protected $listeners = ['bom_item_change' => 'bom_item_change'];

    protected $rules = [
        'nama_bom' => 'required|min:4',
        'produk' => 'required',
        'kuantitas' => 'required',
        'referensi_internal' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validated = $this->validate();

        $grand_total = 0;
        for ($index = 0; $index < sizeof($this->bom_item_list); $index++) {
            $grand_total += $this->bom_item_list[$index]['harga_bom'];
        }

        $bom = Bom::create([
            "nama" => $validated["nama_bom"],
            "kuantitas" => $validated["kuantitas"],
            "id_produk" => $validated["produk"],
            "referensi_internal" => $validated["referensi_internal"],
            "grand_total" => $grand_total,
        ]);


        for ($index = 0; $index < sizeof($this->bom_item_list); $index++) {
            BomDetail::create([
                "id_bom" => $bom->id,
                "id_bahan_baku" =>  $this->bom_item_list[$index]["bahan_baku"],
                "kuantitas" => $this->bom_item_list[$index]["kuantitas"],
                "harga_asli" => $this->bom_item_list[$index]["harga_asli"],
                "harga_bom" => $this->bom_item_list[$index]["harga_asli"] * $this->bom_item_list[$index]["kuantitas"],
            ]);
        }

        return redirect("/bom");
    }

    public function mount()
    {
        $this->kuantitas = 1;
    }

    public function render()
    {
        $produk_list = Produk::where('nama', 'like', '%' . $this->produk_search . '%')->get();
        $bahan_baku_list = BahanBaku::all();

        return view('livewire.bom-form', compact('produk_list', 'bahan_baku_list'));
    }

    public function tambah_bom_item()
    {
        array_push($this->bom_item_list, [
            'bahan_baku' => 'asdafsd',
            'kuantitas' => 1,
            'harga_asli' => '0',
            'harga_bom' => '0',
        ]);
    }

    public function on_bom_item_bahan_change($index, $new_bahan_baku_id)
    {
        if (!isset($this->bom_item_list[$index])) {
            return;
        }

        $old_bahan_baku_id = $this->bom_item_list[$index]['bahan_baku'];
        $is_change = $old_bahan_baku_id != $new_bahan_baku_id;

        if ($is_change) {
            $new_bahan_baku = BahanBaku::find($new_bahan_baku_id);

            $this->bom_item_list[$index]['bahan_baku'] = $new_bahan_baku->id;
            $this->bom_item_list[$index]['kuantitas'] = 1;
            $this->bom_item_list[$index]['harga_asli'] = $new_bahan_baku->harga_beli;
            $this->bom_item_list[$index]['harga_bom'] = $new_bahan_baku->harga_beli * 1;

            $this->dispatch('bom_item_change');
        }
    }

    public function on_bom_item_bahan_delete($index)
    {
        if (!isset($this->bom_item_list[$index])) {
            return;
        }

        unset($this->bom_item_list[$index]);
        $this->bom_item_list = array_values($this->bom_item_list);
        $this->dispatch('bom_item_change');
    }

    public function on_bom_item_qty_change($index, $new_qty)
    {
        if (!isset($this->bom_item_list[$index])) {
            return;
        }

        $this->bom_item_list[$index]['kuantitas'] = $new_qty;
        $this->dispatch('bom_item_change');
    }

    public function bom_item_change()
    {
        $total_biaya = 0;
        foreach ($this->bom_item_list as $index => $bom_item) {
            $this->bom_item_list[$index]['harga_bom'] = is_numeric($bom_item['harga_asli']) && is_numeric($bom_item['kuantitas']) ? $bom_item['harga_asli'] *  $bom_item['kuantitas'] : 0;
            $total_biaya += $this->bom_item_list[$index]['harga_bom'];
        }

        $this->total_biaya = $total_biaya;
        $this->interval_biaya =  $this->biaya_produk - $total_biaya;
    }
}
