@extends('error_base')

@section('title')
    <title>Error : {{ $exception->getStatusCode() }}</title>
@endsection

@section('content')
<section class="vh-100 py-5 bg-image" style="background-image: url({{ asset('/assets/media/source/401background.jpg') }});">
    <div class="d-flex align-items-center justify-content-center h-100">
        <div class="text-center bg-dark text-white p-5 rounded-5">
            <h1 class="display-1 fw-bold">{{ $exception->getStatusCode() }}</h1>
            <p class="fs-2">
                <span class="text-warning">Opps!</span> You cannot access this page!.
            </p>
            <p class="lead">
                {{ $exception->getMessage() }}
            </p>
            <a href="{{ url('/') }}" class="btn btn-primary">Back to Storefront</a>
        </div>
    </div>
</section>
@endsection
