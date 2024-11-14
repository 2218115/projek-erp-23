@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('bahan-baku') }}">Bahan Baku</a></li>
            <li class="breadcrumb-item"><a href="{{ url('bahan-baku') . '/' . $bahan_baku->id }}"> #{{ $bahan_baku->id }}</a>
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body">

                    <form action="{{ url('bahan-baku/' . $bahan_baku->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Bahan Baku</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama', $bahan_baku->nama) }}"
                                        disabled />
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kategori_produk" class="form-label">Kategori</label>
                                    <input type="text"
                                        class="form-control @error('kategori_produk') is-invalid @enderror"
                                        id="kategori_produk" name="kategori_produk"
                                        value="{{ old('kategori_produk', $bahan_baku->kategori_produk->nama ?? '') }}"
                                        disabled />
                                    @error('kategori_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="ukuran" class="form-label">Ukuran</label>
                                    <input type="text" class="form-control @error('ukuran') is-invalid @enderror"
                                        id="ukuran" name="ukuran"
                                        value="{{ old('ukuran', $bahan_baku->ukuran->nama ?? '') }}" disabled />
                                    @error('ukuran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror"
                                        id="model" name="model" value="{{ old('model', $bahan_baku->model) }}"
                                        disabled />
                                    @error('model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="referensi_internal" class="form-label">Referensi Internal</label>
                                    <input type="text"
                                        class="form-control @error('referensi_internal') is-invalid @enderror"
                                        id="referensi_internal" name="referensi_internal"
                                        value="{{ old('referensi_internal', $bahan_baku->referensi_internal) }}"
                                        disabled />
                                    @error('referensi_internal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="barcode" class="form-label">Barcode</label>
                                    <input type="text" class="form-control @error('barcode') is-invalid @enderror"
                                        id="barcode" name="barcode" value="{{ old('barcode', $bahan_baku->barcode) }}"
                                        disabled />
                                    @error('barcode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Masukan Gambar</label>
                                    <div class="border rounded d-flex align-items-center justify-content-center mb-2 ratio ratio-1x1 overflow-hidden"
                                        style="height: 11.4rem; width: 11.4rem;">
                                        <img id="gambar-preview"
                                            src="{{ asset('storage/gambar_bahan_baku/' . $bahan_baku->gambar) }}"
                                            alt="Preview Gambar" class="img-fluid" style="display: block;">
                                    </div>
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                        id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)"
                                        disabled />
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4"
                                        disabled>{{ old('deskripsi', $bahan_baku->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="pajak" class="form-label">Pajak</label>
                                    <input type="number" class="form-control @error('pajak') is-invalid @enderror"
                                        id="pajak" name="pajak" value="{{ old('pajak', $bahan_baku->pajak) }}"
                                        step="0.01" disabled />
                                    @error('pajak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="harga_beli" class="form-label">Harga Beli</label>
                                    <input type="number" class="form-control @error('harga_beli') is-invalid @enderror"
                                        id="harga_beli" name="harga_beli"
                                        value="{{ old('harga_beli', $bahan_baku->harga_beli) }}" step="0.01"
                                        disabled />
                                    @error('harga_beli')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ url('bahan-baku/' . $bahan_baku->id . '/edit') }}"
                                class="btn btn-warning btn-md">
                                <i class="ti ti-edit"></i> Edit
                            </a>

                            <form action="{{ url('bahan-baku/' . $bahan_baku->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-md">
                                    <i class="ti ti-trash"></i> Delete
                                </button>
                            </form>

                            <a href="{{ url('bahan-baku') }}" class="btn btn-secondary btn-md">Kembali</a>
                        </div>
                    </form>
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
