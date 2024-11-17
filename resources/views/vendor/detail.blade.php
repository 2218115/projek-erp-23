@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('vendor') }}">Vendor</a></li>
            <li class="breadcrumb-item"><a href="{{ url('vendor') . '/' . $vendor->id }}"> #{{ $vendor->id }}</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body">
                    <div>
                        <form>
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                        <input type="text" class="form-control" id="nama_perusahaan"
                                            name="nama_perusahaan" value="{{ $vendor->nama }}" disabled />
                                    </div>
                                    <div class="mb-3">
                                        <label for="kontak_penghubung" class="form-label">Kontak Penghubung</label>
                                        <input type="text" class="form-control" id="kontak_penghubung"
                                            name="kontak_penghubung" value="{{ $vendor->kontak_penghubung }}" disabled />
                                    </div>

                                    <div class="mb-3">
                                        <label for="provinsi" class="form-label">Provinsi</label>
                                        <input type="text" class="form-control" id="provinsi" name="provinsi"
                                            value="{{ $vendor->r_provinsi->name }}" disabled />
                                    </div>

                                    <div class="mb-3">
                                        <label for="kota" class="form-label">Kota</label>
                                        <input type="text" class="form-control" id="kota" name="kota"
                                            value="{{ $vendor->r_kota->name }}" disabled />
                                    </div>

                                    <div class="mb-3">
                                        <label for="jalan" class="form-label">Jalan</label>
                                        <input type="text" class="form-control" id="jalan" name="jalan"
                                            value="{{ $vendor->jalan }}" disabled />
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                            value="{{ $vendor->nomor_telepon }}" disabled />
                                    </div>
                                    <div class="mb-3">
                                        <label for="nomor_telepon_mobile" class="form-label">Nomor Telepon Mobile</label>
                                        <input type="text" class="form-control" id="nomor_telepon_mobile"
                                            name="nomor_telepon_mobile" value="{{ $vendor->nomor_telepon_mobile }}"
                                            disabled />
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $vendor->email }}" disabled />
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('vendor/' . $vendor->id . '/edit') }}" class="btn btn-warning btn-md">
                                    <i class="ti ti-edit"></i> Edit
                                </a>

                                <form action="{{ url('vendor/' . $vendor->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-md">
                                        <i class="ti ti-trash"></i> Delete
                                    </button>
                                </form>

                                <a href="{{ url('vendor') }}" class="btn btn-secondary btn-md">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('gambar-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
