@extends('error_base')

@section('title')
    <title>Error : {{ $exception->getStatusCode() }}</title>
@endsection

@section('content')
<section class="vh-100 py-5 bg-image" style="background-image: url({{ asset('/assets/media/source/403background.jpg') }});">
    <div class="d-flex align-items-center justify-content-center h-100">
        <div class="text-center bg-dark text-white p-5 rounded-5">
            <h1 class="display-1 fw-bold">{{ $exception->getStatusCode() }}</h1>
            <p class="fs-2">
                <span class="text-warning">Opps!</span> Something went wrong.
            </p>
            <p class="lead">
                {{ $exception->getMessage() }}
            </p>
            <button onclick="window.location.reload();" class="btn btn-danger">Try reloading this page</button>
        </div>
    </div>
</section>
@endsection
