@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('bahan-baku') }}">Bahan Baku</a></li>
        </ol>
    </nav>

    @livewire('bahan-baku-list')

    <!-- Pagination (if needed) -->
    {{-- <div class="d-flex justify-content-center">
        {{ $produk->links() }}
    </div> --}}
@endsection
