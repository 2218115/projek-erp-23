@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <input type="search" name="search" class="form-control w-50"
                                placeholder="Cari Request For Quotation" wire:model.live="search">
                            <select class="form-select @error('kategori_produk') is-invalid @enderror" id="kategori_produk"
                                name="kategori_produk" wire:model.live="kategori_produk">
                                <option value="">Pilih Kategori Produk</option>
                                {{-- @foreach ($kategori_produk_list as $kategori_produk) --}}
                                {{-- <option value="{{ $kategori_produk->id }}"> {{ $kategori_produk->nama }}</option> --}}
                                {{-- @endforeach --}}
                            </select>
                        </div>


                        <a href="{{ url('produk/tambah') }}" class="btn btn-success">
                            <i class="ti ti-plus-circle"></i> Tambah RFQ
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No</th>
                                    <th>No</th>
                                    <th>No</th>
                                    <th>No</th>
                                    <th>No</th>
                                    <th>No</th>
                                    <th>No</th>
                                    <th>No</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
