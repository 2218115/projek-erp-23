<?php

namespace App\Livewire;

use App\Models\RFQ;
use App\Models\RFQDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class RfqDetailForm extends Component
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

    public $current_status;

    public $generated_status = [];

    /**
     * nama_bahan_baku (dummy)
     * bahan_baku (selectable)
     * deskripsi (editable)
     * kuantitas (editable)
     * harga satuan (editable)
     * pajak (editable)
     * subtotal (calculated)
     * diterima (ketika sudah PO)
     * dibayar (ketika sudah BILLED)
     */
    public $rfq_item_list = array();

    protected $listeners = ['rfq_item_change' => 'rfq_item_change'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function change_to_next_status()
    {
        try {
            if ($this->rfq_id) {
                if ($this->current_status == 'RFQ') { // next status PO
                    $rfq = RFQ::find($this->rfq_id);
                    if ($rfq) {
                        $rfq->id_status = 'PO';
                        $rfq->save();
                    }
                } else if ($this->current_status == 'PO') { // next status VALIDATED
                    $rfq = RFQ::find($this->rfq_id);
                    if ($rfq) {
                        foreach ($rfq->rfq_detail as $index => $rfq_item) {
                            $rfq_item->bahan_baku->update([
                                'stock' => $rfq_item->bahan_baku->stock + $rfq_item->kuantitas,
                            ]);
                            $rfq_item->diterima = $rfq_item->kuantitas;
                            $rfq_item->save();
                        }

                        $rfq->id_status = 'VALIDATED';
                        $rfq->save();
                    }
                } else if ($this->current_status == 'VALIDATED') {
                    $rfq = RFQ::find($this->rfq_id);
                    if ($rfq) {
                        $rfq->id_status = 'WAITING_BILL';
                        $rfq->save();
                    }
                } else if ($this->current_status == 'WAITING_BILL') {
                    $rfq = RFQ::find($this->rfq_id);
                    if ($rfq) {
                        foreach ($rfq->rfq_detail as $index => $rfq_item) {
                            $rfq_item->dibayar = $rfq_item->subtotal;
                            $rfq_item->save();
                        }

                        $rfq->id_status = 'PAID';
                        $rfq->save();
                    }
                }
            }

            return redirect('/rfq/' . $rfq->id);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
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

            return redirect('/rfq/' . $rfq->id . '/edit');
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


            return redirect('/rfq/' . $rfq->id . '/edit');
        }
    }

    public function mount($rfq_id)
    {
        $this->rfq_id = $rfq_id;

        if ($this->rfq_id) {
            $rfq = RFQ::find($this->rfq_id);
            if (!$rfq) {
                abort(404, 'Tidak di temukan RFQ');
            }

            $this->vendor = $rfq->vendor->id;
            $this->vendor_search = $rfq->vendor->nama;
            $this->vendor = $rfq->referensi_vendor;
            $this->tanggal_pesan = Carbon::parse($rfq->tanggal_pesan)->format('Y-m-d');

            $this->total_pajak = $rfq->total_pajak;
            $this->total_tanpa_pajak = $rfq->total_tanpa_pajak;
            $this->grand_total = $rfq->grand_total;
            $this->current_status = $rfq->id_status;


            foreach ($rfq->rfq_detail as $index => $rfq_item) {
                $this->rfq_item_list[] = [
                    'nama_bahan_baku' => $rfq_item->bahan_baku->nama,
                    'bahan_baku' => $rfq_item->bahan_baku->id,
                    'deskripsi' => $rfq_item->deskripsi,
                    'kuantitas' => $rfq_item->kuantitas,
                    'harga_satuan' => $rfq_item->harga_satuan,
                    'pajak' => $rfq_item->pajak,
                    'subtotal' => $rfq_item->subtotal,
                    'diterima' => $rfq_item->diterima,
                    'dibayar' => $rfq_item->dibayar,
                ];
            }
        } else {
        }

        // $this->vendor_list = Vendo::all();
    }

    public function render()
    {
        return view('livewire.rfq-detail-form');
    }
}
