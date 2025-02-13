@extends('layouts.dashboard')

@section('content')
<div class="row">
<div class="col">
    <div class="card w-100">
    <div class="card-body">
        <form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"
            >Email address</label
            >
            <input
            type="email"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            />
            <div id="emailHelp" class="form-text">
            We'll never share your email with anyone else.
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"
            >Password</label
            >
            <input
            type="password"
            class="form-control"
            id="exampleInputPassword1"
            />
        </div>
        <div class="mb-3 form-check">
            <input
            type="checkbox"
            class="form-check-input"
            id="exampleCheck1"
            />
            <label class="form-check-label" for="exampleCheck1"
            >Check me out</label
            >
        </div>
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
        </form>

        <button type="button" class="btn btn-primary">Primary</button>
        <button type="button" class="btn btn-secondary">
        Secondary
        </button>
        <button type="button" class="btn btn-success">Success</button>
        <button type="button" class="btn btn-danger">Danger</button>
        <button type="button" class="btn btn-warning">Warning</button>
        <button type="button" class="btn btn-info">Info</button>
        <button type="button" class="btn btn-light">Light</button>
        <button type="button" class="btn btn-dark">Dark</button>

        <button type="button" class="btn btn-link">Link</button>
    </div>
    </div>
</div>
</div>
@endsection