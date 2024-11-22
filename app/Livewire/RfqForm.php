<?php

namespace App\Livewire;

use App\Models\BahanBaku;
use App\Models\RFQ;
use App\Models\RFQDetail;
use App\Models\Vendor;
use Livewire\Component;

class RfqForm extends Component
{
    public $rfq_id;

    public $vendor;
    public $referensi_vendor;
    public $tanggal_pesan;

    public $vendor_search;
    public $vendor_list;

    public $bahan_baku_list;

    public $total_tanpa_pajak;
    public $total_pajak;
    public $grand_total;

    /**
     * nama_bahan_baku (dummy)
     * bahan_baku (selectable)
     * deskripsi (editable)
     * kuantitas (editable)
     * harga satuan (editable)
     * pajak (editable)
     * subtotal (calculated)
     */
    public $rfq_item_list = array();

    protected $listeners = ['rfq_item_change' => 'rfq_item_change'];

    protected $rules = [
        'vendor' => 'required',
        'referensi_vendor' => 'nullable',
        'tanggal_pesan' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update_status($new_status)
    {
        dd($new_status);
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->rfq_id) {
            $rfq = RFQ::find($this->rfq_id);

            $rfq->id_vendor = $validated['vendor'];
            $rfq->referensi_vendor = $validated['referensi_vendor'];
            $rfq->tanggal_pesan = $validated['tanggal_pesan'];

            $grand_total = 0;
            $total_pajak = 0;
            $total_biaya_tanpa_pajak = 0;

            foreach ($this->rfq_item_list as $index => $rfq_item) {
                $subtotal = is_numeric($rfq_item['harga_satuan']) && is_numeric($rfq_item['kuantitas']) ? $rfq_item['harga_satuan'] *  $rfq_item['kuantitas'] : 0;
                $total_pajak += is_numeric($subtotal) && is_numeric($rfq_item['pajak']) ? $subtotal *  ($rfq_item['pajak'] / 100.0) : 0;

                $total_biaya_tanpa_pajak += $subtotal;
            }

            $grand_total += $total_pajak + $total_biaya_tanpa_pajak;

            $rfq->total_pajak = $total_pajak;
            $rfq->total_tanpa_pajak = $total_biaya_tanpa_pajak;
            $rfq->grand_total = $grand_total;

            RFQDetail::where('id_rfq', '=', $rfq->id)->delete();

            foreach ($this->rfq_item_list as $index => $rfq_item) {
                $subtotal = is_numeric($rfq_item['harga_satuan']) && is_numeric($rfq_item['kuantitas']) ? $rfq_item['harga_satuan'] *  $rfq_item['kuantitas'] : 0;

                RFQDetail::create([
                    'id_rfq' => $rfq->id,
                    'id_bahan_baku' => $rfq_item['bahan_baku'],
                    'deskripsi' => $rfq_item['deskripsi'],
                    'kuantitas' => $rfq_item['kuantitas'],
                    'harga_satuan' => $rfq_item['harga_satuan'],
                    'pajak' => $rfq_item['pajak'],
                    'subtotal' => $subtotal,
                ]);
            }

            return redirect('/rfq/' . $rfq->id);
        } else {
            $grand_total = 0;
            $total_pajak = 0;
            $total_biaya_tanpa_pajak = 0;

            foreach ($this->rfq_item_list as $index => $rfq_item) {
                $subtotal = is_numeric($rfq_item['harga_satuan']) && is_numeric($rfq_item['kuantitas']) ? $rfq_item['harga_satuan'] *  $rfq_item['kuantitas'] : 0;
                $total_pajak += is_numeric($subtotal) && is_numeric($rfq_item['pajak']) ? $subtotal *  ($rfq_item['pajak'] / 100.0) : 0;

                $total_biaya_tanpa_pajak += $subtotal;
            }

            $grand_total += $total_pajak + $total_biaya_tanpa_pajak;

            $rfq = RFQ::create([
                'id_vendor' => $validated['vendor'],
                'id_status' => 'RFQ', // NOTE: RFQ
                'referensi_vendor' => $validated['referensi_vendor'],
                'tanggal_pesan' => $validated['tanggal_pesan'],
                'total_pajak' => $total_pajak, // NOTE: total_biaya_dengan_pajak
                'total_tanpa_pajak' => $total_biaya_tanpa_pajak,
                'grand_total' => $grand_total,
            ]);

            foreach ($this->rfq_item_list as $index => $rfq_item) {
                $subtotal = is_numeric($rfq_item['harga_satuan']) && is_numeric($rfq_item['kuantitas']) ? $rfq_item['harga_satuan'] *  $rfq_item['kuantitas'] : 0;

                RFQDetail::create([
                    'id_rfq' => $rfq->id,
                    'id_bahan_baku' => $rfq_item['bahan_baku'],
                    'deskripsi' => $rfq_item['deskripsi'],
                    'kuantitas' => $rfq_item['kuantitas'],
                    'harga_satuan' => $rfq_item['harga_satuan'],
                    'pajak' => $rfq_item['pajak'],
                    'subtotal' => $subtotal,
                ]);
            }


            return redirect('/rfq/' . $rfq->id);
        }
    }

    public function mount($rfq_id)
    {
        $this->rfq_id = $rfq_id;

        if ($this->rfq_id) {
        } else {
        }

        $this->vendor_list = Vendor::all();
    }

    public function render()
    {
        return view('livewire.rfq-form');
    }

    public function do_vendor_load($query)
    {
        if ($query === '') {
            $this->vendor_list = Vendor::all();
        } else {
            $this->vendor_list = Vendor::where('nama', 'like', '%' . $query . '%')->get();
        }
    }

    public function do_bahan_baku_load($query)
    {
        if ($query === '') {
            $this->bahan_baku_list = BahanBaku::all();
        } else {
            $this->bahan_baku_list = BahanBaku::where('nama', 'like', '%' . $query . '%')->get();
        }
    }

    public function tambah_rfq_item()
    {
        $this->rfq_item_list[] = [
            'nama_bahan_baku' => '',
            'bahan_baku' => '',
            'deskripsi' => '',
            'kuantitas' => '1',
            'harga_satuan' => '',
            'pajak' => '',
            'subtotal' => '0',
        ];
    }

    public function on_rfq_item_bahan_change($index, $new_bahan_baku_id)
    {
        if (!isset($this->rfq_item_list[$index])) {
            return;
        }

        $old_bahan_baku_id = $this->rfq_item_list[$index]['bahan_baku'];
        $is_change = $old_bahan_baku_id != $new_bahan_baku_id;

        if ($is_change) {
            $new_bahan_baku = BahanBaku::find($new_bahan_baku_id);

            $this->rfq_item_list[$index]['nama_bahan_baku'] = $new_bahan_baku->nama;
            $this->rfq_item_list[$index]['bahan_baku'] = $new_bahan_baku->id;
            $this->rfq_item_list[$index]['deskripsi'] = $new_bahan_baku->deskripsi;
            $this->rfq_item_list[$index]['kuantitas'] = 1;
            $this->rfq_item_list[$index]['harga_satuan'] = $new_bahan_baku->harga_beli;
            $this->rfq_item_list[$index]['pajak'] = $new_bahan_baku->pajak;
            $this->rfq_item_list[$index]['subtotal'] = $new_bahan_baku->harga_beli * 1;

            $this->dispatch('rfq_item_change');
        }
    }

    public function hapus_rfq_item($index)
    {
        if (!isset($this->rfq_item_list[$index])) {
            return;
        }

        unset($this->rfq_item_list[$index]);
        $this->rfq_item_list = array_values($this->rfq_item_list);

        $this->dispatch('rfq_item_change');
    }

    public function on_rfq_item_deskripsi_change($index, $new_value)
    {
        $this->rfq_item_list[$index]['deskripsi'] = $new_value;
    }

    public function on_rfq_item_kuantitas_change($index, $new_value)
    {
        $this->rfq_item_list[$index]['kuantitas'] = is_numeric($new_value) ? $new_value : 0;

        $this->dispatch('rfq_item_change');
    }

    public function  on_rfq_item_harga_satuan_change($index, $new_value)
    {
        if (!$this->rfq_item_list[$index]['harga_satuan']) {
            return;
        }

        $this->rfq_item_list[$index]['harga_satuan'] = $new_value;
        $this->dispatch('rfq_item_change');
    }

    public function  on_rfq_item_pajak_change($index, $new_value)
    {
        if (!$this->rfq_item_list[$index]['pajak']) {
            return;
        }

        $this->rfq_item_list[$index]['pajak'] = $new_value;
        $this->dispatch('rfq_item_change');
    }

    public function rfq_item_change()
    {
        $grand_total = 0;
        $total_pajak = 0;
        $total_biaya_tanpa_pajak = 0;

        foreach ($this->rfq_item_list as $index => $rfq_item) {
            $this->rfq_item_list[$index]['subtotal'] = is_numeric($rfq_item['harga_satuan']) && is_numeric($rfq_item['kuantitas']) ? $rfq_item['harga_satuan'] *  $rfq_item['kuantitas'] : 0;
            $total_pajak += is_numeric($rfq_item['subtotal']) && is_numeric($rfq_item['pajak']) ? $rfq_item['subtotal'] *  ($rfq_item['pajak'] / 100.0) : 0;

            $total_biaya_tanpa_pajak += $this->rfq_item_list[$index]['subtotal'];
        }

        $grand_total += $total_pajak + $total_biaya_tanpa_pajak;

        $this->total_pajak = $total_pajak;
        $this->total_tanpa_pajak = $total_biaya_tanpa_pajak;
        $this->grand_total = $grand_total;
    }
}
