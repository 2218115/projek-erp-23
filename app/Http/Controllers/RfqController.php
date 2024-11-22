<?php

namespace App\Http\Controllers;

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
}
