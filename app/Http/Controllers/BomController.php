<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BomController extends Controller
{
    public function index()
    {
        return view('bom.index');
    }

    public function create()
    {
        return view('bom.tambah');
    }
}
