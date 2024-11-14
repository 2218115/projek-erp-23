@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('produk') }}">Produk</a></li>
        </ol>
    </nav>

    @livewire('produk-list')

    <!-- Pagination (if needed) -->
    {{-- <div class="d-flex justify-content-center">
        {{ $produk->links() }}
    </div> --}}
@endsection
