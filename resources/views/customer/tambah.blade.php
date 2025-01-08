@extends('layouts.dashboard')

@section('content')
    @livewire('customer-form', [
        'customer_id' => null,
    ])
@endsection
