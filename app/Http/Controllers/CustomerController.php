<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index');
    }

    public function tambah()
    {
        return view('customer.tambah');
    }

    public function edit($id)
    {
        return view('customer.edit');
    }

    public function show($id)
    {
        $customer = Customer::with(['r_provinsi', 'r_kota'])->find($id);
        return view('customer.detail', ['customer' => $customer]);
    }
}
