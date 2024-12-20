@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('rfq') }}">RFQ</a></li>

            <li class="breadcrumb-item"><a href="{{ url('rfq/tambah') }}">Tambah</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body">

                    @livewire('rfq-form', [
                        'rfq_id' => null,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection