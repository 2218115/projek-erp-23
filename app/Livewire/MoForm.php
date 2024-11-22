<?php

namespace App\Livewire;

use App\Models\Bom;
use App\Models\MO;
use App\Models\MODetail;
use App\Models\Produk;
use Exception;
use Livewire\Component;

class MoForm extends Component
{
    public $mo_id;

    public $produk;
    public $produk_list;
    public $produk_search;

    public $bom;
    public $bom_list;
    public $bom_search;

    public $tanggal_produksi;
    public $kuantitas_produksi;

    public $selected_bom;


    /**
     * nama_bahan_baku
     * to_consumed
     * reserved
     * available
     */
    public $mo_list = [];

    public function mount()
    {
        $this->produk_list = collect();
        $this->bom_list = collect();
        $this->kuantitas_produksi = 1;
    }

    protected $rules = [
        'produk' => 'required',
        'bom' => 'required',
        'kuantitas_produksi' => 'required',
        'tanggal_produksi' => 'required',
    ];

    public function render()
    {
        return view('livewire.mo-form');
    }

    public function save()
    {
        $validated = $this->validate();

        try {
            if ($this->mo_id) {
                // TODO: update
            } else {
                $mo = MO::create([
                    'id_status' => 'DRAFT',
                    'id_produk' => $validated['produk'],
                    'id_bom' => $validated['bom'],
                    'kuantitas' => $validated['kuantitas_produksi'],
                    'tanggal_produksi' => $validated['tanggal_produksi'],
                ]);

                $bom = Bom::with('bom_detail')->where('id', '=', $validated['bom'])->where('id_produk', '=', $validated['produk'])->first();
                if (!$bom) {
                    throw new Exception('bom is not finded');
                }

                foreach ($bom->bom_detail  as $key => $bom_item) {
                    MODetail::create([
                        'id_mo' => $mo->id,
                        'id_bahan_baku' => $bom_item->bahan_baku->id,
                        'to_consumed' => $mo->kuantitas * $bom_item->kuantitas,
                        'reserved' => 0,
                        'is_available' => '?',
                    ]);
                }
            }

            return redirect('/mo/' . $mo->id);
        } catch (Exception $e) {
            error_log($e->getMessage());
            dd($e->getMessage());
        }
    }

    public function do_produk_load($query)
    {
        if ($query === '') {
            $this->produk_list = Produk::all();
        } else {
            $this->produk_list = Produk::where('nama', 'like', '%' . $query . '%')->get();
        }
    }

    public function do_bom_load($query)
    {
        if (!$this->produk) {
            return;
        }

        if ($query === '') {
            $this->bom_list = Bom::where('id_produk', '=', $this->produk)->get();
        } else {
            $this->bom_list = Bom::where('nama', 'like', '%' . $query . '%')->where('id_produk', '=', $this->produk)->get();
        }
    }

    public function on_bom_change()
    {
        if (!$this->bom) {
            return;
        }

        $this->selected_bom = Bom::find($this->bom);

        if ($this->selected_bom) {
            $this->mo_list = [];

            foreach ($this->selected_bom->bom_detail  as $key => $bom_item) {
                $this->mo_list[] = [
                    'nama_bahan_baku' => '[' . $bom_item->bahan_baku->referensi_internal . ']' . $bom_item->bahan_baku->nama,
                    'to_consumed' => is_numeric($this->kuantitas_produksi) ? $this->kuantitas_produksi * $bom_item->kuantitas : 0,
                    'reserved' => 0,
                    'is_available' => 0,
                ];
            }
        }
    }

    public function on_quantity_change()
    {
        if ($this->selected_bom) {
            $this->mo_list = [];
            foreach ($this->selected_bom->bom_detail  as $key => $bom_item) {
                $this->mo_list[] = [
                    'nama_bahan_baku' => '[' . $bom_item->bahan_baku->referensi_internal . ']' . $bom_item->bahan_baku->nama,
                    'to_consumed' => is_numeric($this->kuantitas_produksi) ? $this->kuantitas_produksi * $bom_item->kuantitas : 0,
                    'reserved' => 0,
                    'is_available' => 0,
                ];
            }
        }
    }
}
