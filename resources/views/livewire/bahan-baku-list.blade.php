<div>
    <div class="row mb-4">
        <div class="col-md-6">
            <h3>List Bahan Baku</h3>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end gap-2">
                <input type="search" name="search" class="form-control w-50" placeholder="Cari Bahan Baku..."
                    wire:model.live="search">

                {{-- <button type="submit" class="btn btn-primary ms-2">Cari</button> --}}

                <a href="{{ url('bahan-baku/tambah') }}" class="btn btn-success">
                    <i class="ti ti-plus-circle"></i> Tambah Bahan Baku
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
        @if ($bahan_baku_list->count() > 0)
            <div class="row">
                @foreach ($bahan_baku_list as $bahan_baku)
                    <div class="col-md-4 mb-4">
                        <a href="{{ url('bahan-baku/' . $bahan_baku->id) }}" class="text-decoration-none text-dark">
                            <div class="card">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset('storage/gambar_bahan_baku/' . $bahan_baku->gambar) }}"
                                        class="card-img-top" alt="{{ $bahan_baku->nama }}">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $bahan_baku->nama }}</h5>
                                    <p class="card-text">{{ Str::limit($bahan_baku->deskripsi, 100) }}</p>
                                    <p class="card-text"><strong>Harga:</strong> Rp
                                        {{ number_format($bahan_baku->harga_beli, 0, ',', '.') }}
                                    </p>

                                    <div class="d-flex mt-4">
                                        <a href="{{ url('bahan-baku/' . $bahan_baku->id . '/edit') }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="ti ti-edit"></i> Edit
                                        </a>

                                        <form action="{{ url('bahan-baku/' . $bahan_baku->id) }}" method="POST"
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

        {{-- {{ $bahan_baku_list->links() }} --}}
    </div>
</div>
