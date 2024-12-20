<?php

namespace App\Http\Controllers;

use App\Models\MO;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ManufacuringController extends Controller
{
    public function index()
    {
        return view('mo.index');
    }

    public function create()
    {
        return view('mo.tambah');
    }

    public function show($mo_id)
    {
        return view('mo.detail', [
            'mo_id' => $mo_id,
        ]);
    }

    public function edit($mo_id)
    {
        return view('mo.edit', [
            'mo_id' => $mo_id,
        ]);
    }

    public function report_detail($id)
    {
        $mo = MO::find($id);
        $pdf = Pdf::loadView('mo.report-detail', [
            'mo' => $mo,
        ]);
        return $pdf->download($id . '-mo.pdf');
    }
}
