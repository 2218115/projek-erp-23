@extends('layouts.dashboard')

@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('customer') }}">Customer</a></li>
                <li class="breadcrumb-item active" aria-current="page">#{{ $customer->id }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
                <div class="card w-100">
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_customer" class="form-label">Nama Customer</label>
                                        <input type="text" class="form-control" id="nama_customer" name="nama_customer"
                                            value="{{ $customer->nama }}" disabled />
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                        <input type="text" class="form-control" id="nama_perusahaan"
                                            name="nama_perusahaan" value="{{ $customer->nama_perusahaan }}" disabled />
                                    </div>

                                    <div class="mb-3">
                                        <label for="provinsi" class="form-label">Provinsi</label>
                                        <select class="form-select" id="provinsi" name="provinsi" disabled>
                                            <option value="">{{ $customer->r_provinsi->name ?? 'Tidak ada data' }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kota" class="form-label">Kota</label>
                                        <select class="form-select" id="kota" name="kota" disabled>
                                            <option value="">{{ $customer->r_kota->name ?? 'Tidak ada data' }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="jalan" class="form-label">Jalan</label>
                                        <input type="text" class="form-control" id="jalan" name="jalan"
                                            value="{{ $customer->jalan }}" disabled />
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="npwp" class="form-label">NPWP</label>
                                        <input type="text" class="form-control" id="npwp" name="npwp"
                                            value="{{ $customer->npwp }}" disabled />
                                    </div>
                                    <div class="mb-3">
                                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                            value="{{ $customer->nomor_telepon }}" disabled />
                                    </div>
                                    <div class="mb-3">
                                        <label for="nomor_telepon_mobile" class="form-label">Nomor Telepon Mobile</label>
                                        <input type="text" class="form-control" id="nomor_telepon_mobile"
                                            name="nomor_telepon_mobile" value="{{ $customer->nomor_telepon_mobile }}"
                                            disabled />
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $customer->email }}" disabled />
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ url('customer') }}" class="btn btn-secondary w-48">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
