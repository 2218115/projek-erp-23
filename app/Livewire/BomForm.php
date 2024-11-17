<?php

namespace App\Livewire;

use App\Models\BahanBaku;
use App\Models\Bom;
use App\Models\BomDetail;
use App\Models\Produk;
use Livewire\Component;

class BomForm extends Component
{
    public $bom_id;

    public $produk_search;

    public $bahan_baku_list;

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

        if ($this->bom_id) {
            $bom = Bom::find($this->bom_id);

            $grand_total = 0;
            for ($index = 0; $index < sizeof($this->bom_item_list); $index++) {
                $grand_total += $this->bom_item_list[$index]['harga_bom'];
            }

            $bom->nama = $validated["nama_bom"];
            $bom->kuantitas =  $validated["kuantitas"];
            $bom->id_produk =  $validated["produk"];
            $bom->referensi_internal =  $validated["referensi_internal"];
            $bom->grand_total =  $grand_total;

            $bom->save();

            // NOTE: hapus semua bom_detail yang lama
            BomDetail::where('id_bom', $bom->id)->delete();

            // NOTE: buat bom_detail yang baru
            for ($index = 0; $index < sizeof($this->bom_item_list); $index++) {
                BomDetail::create([
                    "id_bom" => $bom->id,
                    "id_bahan_baku" =>  $this->bom_item_list[$index]["bahan_baku"],
                    "kuantitas" => $this->bom_item_list[$index]["kuantitas"],
                    "harga_asli" => $this->bom_item_list[$index]["harga_asli"],
                    "harga_bom" => $this->bom_item_list[$index]["harga_asli"] * $this->bom_item_list[$index]["kuantitas"],
                ]);
            }
        } else {
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
        }

        return redirect("/bom");
    }

    public function mount($bom_id)
    {
        $this->bom_id = $bom_id;

        if ($this->bom_id) {
            $bom = Bom::find($this->bom_id);
            if (!$bom) {
                abort(404, 'Bom Tidak di temukan');
            }
            $this->nama_bom = $bom->nama;
            $this->kuantitas = $bom->kuantitas;

            $this->produk_search = $bom->produk->nama;
            $this->produk = $bom->produk->id;

            $this->referensi_internal = $bom->referensi_internal;
            $this->harga_jual = $bom->produk->harga_jual;
            $this->biaya_produk = $bom->produk->biaya_produk;

            foreach ($bom->bom_detail as $index => $bom_item) {
                $this->bom_item_list[$index]['harga_bom'] = $bom_item->harga_bom;
                $this->bom_item_list[$index]['harga_asli'] = $bom_item->harga_asli;
                $this->bom_item_list[$index]['kuantitas'] = $bom_item->kuantitas;
                $this->bom_item_list[$index]['bahan_baku'] = $bom_item->bahan_baku->id;
                $this->bom_item_list[$index]['nama_bahan_baku'] = $bom_item->bahan_baku->nama;
            }

            $this->total_biaya = $bom->grand_total;
            $this->interval_biaya = $bom->grand_total - $bom->produk->biaya_produk;
        } else {
            $this->kuantitas = 1;
        }
    }

    public function render()
    {
        $produk_list = Produk::where('nama', 'like', '%' . $this->produk_search . '%')->get();

        return view('livewire.bom-form', [
            'produk_list' => $produk_list,
            'bahan_baku_list' => $this->bahan_baku_list
        ]);
    }

    public function tambah_bom_item()
    {
        array_push($this->bom_item_list, [
            'bahan_baku' => '',
            'nama_bahan_baku' => '',
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

    public function bahan_baku_search($query)
    {
        if ($query != '') {
            $this->bahan_baku_list = BahanBaku::where('nama', 'like', '%' . $query . '%')->get();
        } else {
            $this->bahan_baku_list = BahanBaku::all();
        }
    }
}
