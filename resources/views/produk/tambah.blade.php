@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('produk') }}">Produk</a></li>

            <li class="breadcrumb-item"><a href="{{ url('produk/tambah') }}">Tambah Produk</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body">

                    <form action="{{ url('produk') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
                                        id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" />
                                    @error('nama_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kategori_produk" class="form-label">Kategori Produk</label>
                                    <input type="text"
                                        class="form-control @error('kategori_produk') is-invalid @enderror"
                                        id="kategori_produk" name="kategori_produk" value="{{ old('kategori_produk') }}" />
                                    @error('kategori_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ukuran" class="form-label">Ukuran</label>
                                    <input type="text" class="form-control @error('ukuran') is-invalid @enderror"
                                        id="ukuran" name="ukuran" value="{{ old('ukuran') }}" />
                                    @error('ukuran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror"
                                        id="model" name="model" value="{{ old('model') }}" />
                                    @error('model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="garansi" class="form-label">Garansi</label>
                                    <input type="text" class="form-control @error('garansi') is-invalid @enderror"
                                        id="garansi" name="garansi" value="{{ old('garansi') }}" />
                                    @error('garansi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="referensi_internal" class="form-label">Referensi Internal</label>
                                    <input type="text"
                                        class="form-control @error('referensi_internal') is-invalid @enderror"
                                        id="referensi_internal" name="referensi_internal"
                                        value="{{ old('referensi_internal') }}" />
                                    @error('referensi_internal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="barcode" class="form-label">Barcode</label>
                                    <input type="text" class="form-control @error('barcode') is-invalid @enderror"
                                        id="barcode" name="barcode" value="{{ old('barcode') }}" />
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
                                        <img id="gambar-preview" src="#" alt="Preview Gambar" class="img-fluid"
                                            style="display: none;">
                                        <span>
                                            <i class="ti ti-picture"></i>
                                        </span>
                                    </div>
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                        id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)" />
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                        rows="4">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="pajak" class="form-label">Pajak</label>
                                    <input type="number" class="form-control @error('pajak') is-invalid @enderror"
                                        id="pajak" name="pajak" value="{{ old('pajak') }}" step="0.01" />
                                    @error('pajak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="harga_jual" class="form-label">Harga Jual</label>
                                    <input type="number" class="form-control @error('harga_jual') is-invalid @enderror"
                                        id="harga_jual" name="harga_jual" value="{{ old('harga_jual') }}"
                                        step="0.01" />
                                    @error('harga_jual')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end gap-4">
                            <a href="{{ url('produk') }}" class="btn btn-secondary w-48">Batal</a>
                            <button type="submit" class="btn btn-primary w-48">Simpan Produk</button>
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
