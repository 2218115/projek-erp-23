@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('bom') }}">BOM</a></li>
            <li class="breadcrumb-item"><a href="{{ url('bom') . '/' . $bom->id }}"> #{{ $bom->id }}</a></li>
        </ol>
    </nav>


    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{url('bom/report/' . $bom->id)}}" type="submit" class="btn btn-danger btn-md">
                            <i class="ti ti-book"></i> Cetak Bom
                        </a>
                    </div>

                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_bom" class="form-label">Nama BOM</label>
                                    <input type="text" class="form-control @error('nama_bom') is-invalid @enderror"
                                        id="nama_bom" name="nama_bom" value="{{ $bom->nama }}" disabled />
                                    @error('nama_bom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="produk" class="form-label">Produk</label>
                                    <input type="text" class="form-control @error('produk') is-invalid @enderror"
                                        id="produk" name="produk" value="{{ $bom->produk->nama }}" disabled />
                                    @error('produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="harga_jual" class="form-label">Harga Jual</label>
                                    <input type="text" class="form-control" id="harga_jual" name="harga_jual"
                                        value="{{ format_rupiah($bom->produk->harga_jual) }}" disabled />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kuantitas" class="form-label">Kuantitas</label>
                                    <input type="number" class="form-control" id="kuantitas" name="kuantitas"
                                        value="1" disabled />
                                </div>
                                <div class="mb-3">
                                    <label for="referensi_internal" class="form-label">Referensi Internal</label>
                                    <input type="text"
                                        class="form-control @error('referensi_internal') is-invalid @enderror"
                                        id="referensi_internal" name="referensi_internal"
                                        value="{{ $bom->referensi_internal }}" disabled />
                                    @error('referensi_internal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="biaya_produk" class="form-label">Biaya Produk</label>
                                    <input type="text" class="form-control" id="biaya_produk" name="biaya_produk"
                                        value="{{ format_rupiah($bom->produk->biaya_produk) }}" disabled />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ url('bom/' . $bom->id . '/edit') }}" class="btn btn-warning btn-md">
                                <i class="ti ti-edit"></i> Edit
                            </a>

                            <form action="{{ url('bom/' . $bom->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-md">
                                    <i class="ti ti-trash"></i> Delete
                                </button>
                            </form>

                            <a href="{{ url('bom') }}" class="btn btn-secondary btn-md">Kembali</a>
                        </div>
                    </form>

                    <!-- Tabel BOM -->
                    <div class="mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><i class="ti ti-hash"></i> No</th>
                                    <th scope="col"><i class="ti ti-tag"></i> Nama Bahan</th>
                                    <th scope="col"><i class="ti ti-list-numbers"></i> Kuantitas</th>
                                    <th scope="col"><i class="ti ti-box"></i> Harga Asli</th>
                                    <th scope="col"><i class="ti ti-slash"></i> Harga BOM</th>
                                    <th scope="col"><i class="ti ti-settings"></i> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bom->bom_detail as $index => $bom_item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $bom_item->bahan_baku->nama }}</td>
                                        <td>{{ $bom_item->kuantitas }}</td>
                                        <td>{{ format_rupiah($bom_item->harga_asli) }}</td>
                                        <td>{{ format_rupiah($bom_item->harga_bom) }}</td>
                                        <td>
                                            <!-- Hapus Button hanya tampil, tidak ada aksi -->
                                            <button class="btn btn-danger btn-sm" disabled><i class="ti ti-trash"></i>
                                                Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="3"></td>
                                    <td>Total Biaya</td>
                                    <td>
                                        <b>{{ format_rupiah($bom->grand_total) }}</b>
                                    </td>
                                    <td colspan="1"></td>
                                </tr>

                                <tr>
                                    <td colspan="3"></td>
                                    <td>Interval Biaya</td>
                                    <td>
                                        <b>{{ format_rupiah($bom->produk->biaya_produk - $bom->grand_total) }}</b>
                                    </td>
                                    <td colspan="1"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
