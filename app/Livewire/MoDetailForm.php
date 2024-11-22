<?php

namespace App\Livewire;

use App\Models\Bom;
use App\Models\MO;
use App\Models\MODetail;
use App\Models\Produk;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class MoDetailForm extends Component
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

    public $current_status;

    public function mount($mo_id)
    {
        $this->mo_id = $mo_id;

        $mo = MO::find($mo_id);
        $this->produk = $mo->produk;
        $this->produk_search = $mo->produk->nama;
        $this->kuantitas_produksi = $mo->kuantitas;
        $this->tanggal_produksi = Carbon::parse($mo->tanggal_produksi)->format('Y-m-d');
        $this->bom = $mo->bom;
        $this->bom_search = $mo->bom->nama;
        $this->selected_bom = $mo->bom;

        $mo_detail_list = MODetail::where('id_mo', '=', $mo->id)->get();

        $this->mo_list = [];

        foreach ($mo_detail_list  as $key => $mo_item) {
            $this->mo_list[] = [
                'nama_bahan_baku' => $mo_item->bahan_baku->nama,
                'to_consumed' => $mo_item->to_consumed,
                'reserved' => $mo_item->reserved,
                'is_available' => $mo_item->is_available,
            ];
        }

        $this->current_status = $mo->id_status;
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
        return view('livewire.mo-detail-form');
    }

    public function change_to_next_status()
    {
        try {

            $mo = MO::find($this->mo_id);

            if ($this->current_status == 'DRAFT') {
                $mo->update([
                    'id_status' => 'CONFIRMED',
                ]);
            } else if ($this->current_status == 'CONFIRMED' || $this->current_status == 'CA_NOT_AVAILABLE') {
                // cek stock bahan baku yang di perlukan
                $is_available_all = true;

                $mo_detail = $mo->mo_detail;
                foreach ($mo_detail  as $index => $mo_item) {
                    $stock_bahan_baku = $mo_item->bahan_baku->stock;
                    $to_consumed = $mo_item->to_consumed;
                    $sisa_bahan_baku = $stock_bahan_baku - $to_consumed;

                    if ($sisa_bahan_baku < 0) {
                        $is_available_all = false;

                        $mo_item->update([
                            'is_available' => 'F',
                            'reserved' => $sisa_bahan_baku,
                        ]);
                    } else {
                        $mo_item->update([
                            'is_available' => 'T',
                            'reserved' => $to_consumed,
                        ]);
                    }
                }

                $mo->update([
                    'id_status' => $is_available_all ? 'CA_AVAILABLE' : 'CA_NOT_AVAILABLE',
                ]);
            } else if ($this->current_status == 'CA_AVAILABLE') {
                $mo->update([
                    'id_status' => 'PRODUCE',
                ]);
            } else if ($this->current_status == 'PRODUCE') {
                // update stock bahan baku
                $mo_detail = $mo->mo_detail;
                foreach ($mo_detail  as $index => $mo_item) {
                    $mo_item->bahan_baku->update([
                        'stock' => $mo_item->bahan_baku->stock - $mo_item->reserved,
                    ]);
                }

                // update stock produk
                $mo->produk->update([
                    'stock' => $mo->produk->stock + $mo->kuantitas,
                ]);

                $mo->update([
                    'id_status' => 'DONE',
                ]);
            }

            $this->current_status = $mo->id_status;

            return redirect('/mo/' . $mo->id); // Hack To calling mount again
        } catch (Exception $e) {
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
