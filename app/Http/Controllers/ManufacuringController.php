<?php

namespace App\Http\Controllers;

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
}
