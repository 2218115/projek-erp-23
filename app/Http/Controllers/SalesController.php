<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function create() {
        return view('sales.tambah');
    }

    public function index() {
        return view('sales.index');
    }

    public function delivery() {
        return view('sales.delivery');
    }
}
