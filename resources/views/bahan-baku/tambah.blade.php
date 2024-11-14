@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('bahan-baku') }}">Bahan Baku</a></li>

            <li class="breadcrumb-item"><a href="{{ url('bahan-baku/tambah') }}">Tambah Bahan Baku</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body">

                    @livewire('bahan-baku-form', [
                        'produk_id' => null,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
