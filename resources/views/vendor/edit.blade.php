@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('vendor') }}">Vendor</a></li>
            <li class="breadcrumb-item"><a href="{{ url('vendor') . '/' . $vendor_id }}"> #{{ $vendor_id }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('vendor') . '/' . $vendor_id . '/edit' }}"> Edit</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body">
                    @livewire('vendor-form', [
                        'vendor_id' => $vendor_id,
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script></script>
@endsection
