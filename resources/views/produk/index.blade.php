@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('produk') }}">Produk</a></li>
        </ol>
    </nav>

    <div class="row mb-4">
        <div class="col-md-6">
            <h3>List Produk</h3>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end gap-2">
                <input type="text" name="search" class="form-control w-50" placeholder="Cari produk..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary ms-2">Cari</button>

                <a href="{{ url('produk/tambah') }}" class="btn btn-success">
                    <i class="ti ti-plus-circle"></i> Tambah Produk
                </a>
            </div>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="row">
        @foreach ($list_produk as $produk)
            <div class="col-md-4 mb-4">
                <a href="{{ url('produk/' . $produk->id) }}" class="text-decoration-none text-dark">
                    <div class="card">
                        <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-top"
                            alt="{{ $produk->nama_produk }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                            <p class="card-text">{{ Str::limit($produk->deskripsi, 100) }}</p>
                            <p class="card-text"><strong>Harga:</strong> Rp
                                {{ number_format($produk->harga_jual, 0, ',', '.') }}
                            </p>

                            <div class="d-flex mt-4">
                                <a href="{{ url('produk/' . $produk->id . '/edit') }}" class="btn btn-warning btn-sm">
                                    <i class="ti ti-edit"></i> Edit
                                </a>

                                <form action="{{ url('produk/' . $produk->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm ms-2">
                                        <i class="ti ti-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Pagination (if needed) -->
    {{-- <div class="d-flex justify-content-center">
        {{ $produk->links() }}
    </div> --}}
@endsection
