@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('rfq') }}">BOM</a></li>
            <li class="breadcrumb-item"><a href="{{ url('rfq') . '/' . $rfq_id }}"> #{{ $rfq_id }}</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body">
                    @livewire('rfq-detail-form', [
                        'rfq_id' => $rfq_id,
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
