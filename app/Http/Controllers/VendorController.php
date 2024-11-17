<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        return view('vendor.index');
    }


    public function create()
    {
        return view('vendor.tambah');
    }

    public function show($vendor_id)
    {
        $vendor = Vendor::find($vendor_id);

        return view('vendor.detail', compact('vendor'));
    }

    public function edit($vendor_id)
    {
        return view('vendor.edit', compact('vendor_id'));
    }
}
