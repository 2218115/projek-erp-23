@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('mo') }}">Manufacturing Order</a></li>
            <li class="breadcrumb-item"><a href="{{ url('mo') . '/' . $mo_id }}"> #{{ $mo_id }}</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body">

                    @livewire('mo-detail-form', [
                        'mo_id' => $mo_id,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script></script>
@endsection