@extends('layouts.dashboard')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('vendor') }}">Vendor</a></li>
        </ol>
    </nav>

    @livewire('vendor-list')
@endsection
