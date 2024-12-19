<div>
    <div class="row mb-4">
        <div class="col-md-6">
            <h3>List Produk</h3>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end gap-2">
                <input type="search" name="search" class="form-control w-50" placeholder="Cari produk..."
                    wire:model.live="search">

                {{-- <button type="submit" class="btn btn-primary ms-2">Cari</button> --}}

                <a href="{{ url('produk/tambah') }}" class="btn btn-success">
                    <i class="ti ti-plus-circle"></i> Tambah Produk
                </a>

                <a href="{{ url('produk/report') }}" class="btn btn-secondary">
                    <i class="ti ti-plus-circle"></i> Report Produk
                </a>
            </div>
        </div>
    </div>

    <div wire:loading>
        <div class="row">
            @for ($index = 0; $index < 6; $index++)
                <div class="col-md-4 mb-4">
                    <div class="card shimmer-loading">
                        <div class="ratio ratio-4x3 bg-light"></div>
                        <div class="card-body">
                            <h5 class="card-title bg-light rounded-3 shimmer"></h5>
                            <p class="card-text bg-light rounded-3 shimmer mb-3"></p>
                            <p class="card-text bg-light rounded-3 shimmer"></p>

                            <div class="d-flex mt-4">
                                <button class="btn btn-sm shimmer"></button>
                                <button class="btn btn-sm shimmer ms-2"></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div wire:loading.remove>
        @if ($list_produk->count() > 0)
            <div class="row">
                @foreach ($list_produk as $produk)
                    <div class="col-md-3 mb-2">
                        <a href="{{ url('produk/' . $produk->id) }}" class="text-decoration-none text-dark">
                            <div class="card">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset('storage/gambar_produk/' . $produk->gambar) }}"
                                        class="card-img-top" alt="{{ $produk->nama }}">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $produk->referensi_internal ? ' [' . $produk->referensi_internal . '] ' . $produk->nama : $produk->nama }}
                                    </h5>
                                    <p class="card-text">{{ Str::limit($produk->deskripsi, 20) }}</p>
                                    <p class="card-text"><strong>Harga:</strong> Rp
                                        {{ number_format($produk->harga_jual, 0, ',', '.') }}
                                    </p>
                                    <p class="card-text"><strong>Stock:</strong>
                                        {{ $produk->stock }}
                                    </p>

                                    <div class="d-flex mt-4">
                                        <a href="{{ url('produk/' . $produk->id . '/edit') }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="ti ti-edit"></i> Edit
                                        </a>

                                        <form action="{{ url('produk/' . $produk->id) }}" method="POST"
                                            class="d-inline">
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
        @else
            <div class="col-md-12 d-flex align-items-center justify-content-center" style="height: 200px;">
                <div class="text-center">
                    Tidak Menemukan Produk dengan Kata Kunci, <strong>{{ $search }} </strong>
                </div>
            </div>
        @endif

        {{ $list_produk->links() }}
    </div>
</div>
