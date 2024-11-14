@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('produk') }}">Produk</a></li>
            <li class="breadcrumb-item"><a href="{{ url('produk') . '/' . $bahan_baku_id }}"> #{{ $bahan_baku_id }}</a></li>

            <li class="breadcrumb-item"><a href="{{ url('produk') . '/' . $bahan_baku_id . '/edit' }}"> Edit</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body">
                    @livewire('bahan-baku-form', [
                        'bahan_baku_id' => $bahan_baku_id,
                    ])
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
