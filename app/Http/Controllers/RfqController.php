<?php

namespace App\Http\Controllers;

use App\Models\RFQ;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RfqController extends Controller
{
    public function index()
    {
        return view('rfq.index');
    }

    public function create()
    {
        return view('rfq.tambah');
    }

    public function show($rfq_id)
    {
        return view('rfq.detail', compact('rfq_id'));
    }

    public function report_detail($id)
    {
        $rfq = RFQ::find($id);

        $nama_perusahaan = "PT KELOMPOK ERP23-MEBEL JAYA";
        $alamat_penerima = "Jln. Raya Karanglo Km.2 Malang, Jawa Timur, 65145, Indonesia. Telp. 0341-417636. Fax. 0341-417634 Indonesia.";
        $alamat_pengirim = $rfq->vendor->r_provinsi->name . ', ' . $rfq->vendor->r_kota->name . ', ' . $rfq->jalan;

        $quotationData = [
            'origin_address' => 'asdfasdf',
            'destination_address' => 'Jln. Raya Karanglo Km.2 Malang, Jawa Timur, 65145, Indonesia. Telp. 0341-417636. Fax. 0341-417634 Indonesia.',
            'status' => 'OK',
            'items' => [],
        ];

        $pdf = Pdf::loadView('rfq.report-detail', [
            'rfq' => $rfq,
            'nama_perusahaan' => $nama_perusahaan,
            'quotationData' => $quotationData,
            'alamat_penerima' => $alamat_penerima,
            'alamat_pengirim' => $alamat_pengirim,
        ]);
        return $pdf->download($id . '-rfq.pdf');
    }
}
