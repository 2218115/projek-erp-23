@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body">
                    @livewire('rfq-list')
                </div>
            </div>
        </div>
    </div>
@endsection
