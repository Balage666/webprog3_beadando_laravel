@extends('main')

@section('title')
    <title>StoreFront</title>
@endsection

@section('content')

<section class="min-vh-100 bg-image p-5" style="background-image: url({{ asset('/assets/media/source/storefrontBackground.jpg') }});">
    <div class="container bg-dark text-white p-5 rounded-5 mb-4">

        @if (Session::has('message'))
            <div class="alert alert-primary" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif

        <div class="row justify-content-center gap-3">
            <h1 class="text-center">View our products! <i class="fa-brands fa-product-hunt"></i> </h1>

            @forelse ($GardenTools as $gardenTool)
                <div class="card bg-secondary text-white mb-4 border border-5 {{ $gardenTool->stock == 0 ? "border-danger" : "border-info" }}" style="width: 18rem;">
                    <div class="card-header">

                        @if ($gardenTool->stock == 0)
                            <span class="badge bg-danger">Out of Stock</span>
                        @else
                            <span class="badge bg-info">In Stock: {{ $gardenTool->stock }}</span>
                        @endif

                    </div>
                    <img src="{{ asset($gardenTool->image) }}" alt="{{ $gardenTool->name }}" class="card-img-top" style="height: 10rem;">

                    <div class="card-body">
                        <h5 class="card-title">{{ $gardenTool->name }}</h5>
                        <p class="card-text">{{ Str::words($gardenTool->description, 15, $end=' (...) ') }}</p>
                    </div>

                    <div class="card-footer">
                        <p class="card-text border {{ $gardenTool->stock == 0 ? "border-danger bg-danger" : "border-info bg-info" }} border-info bg-info rounded-pill text-center">Price: {{ $gardenTool->price }} Ft. </p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="/gardentool/show/{{ $gardenTool->id }}" class="btn {{ $gardenTool->stock == 0 ? "btn-danger" : "btn-info" }} text-white">Show <i class="fa-solid fa-eye"></i> </a>
                            <a href="#" class="btn {{ $gardenTool->stock == 0 ? "btn-danger" : "btn-primary" }}">Add to Cart <i class="fa-solid fa-cart-plus"></i> </a>
                        </div>
                    </div>

                </div>
            @empty
                <h3 class="text-center text-white">Oops, there are no products to buy!</h3>
            @endforelse

        </div>

        <div class="row justify-content-center">
            <ul class="pagination justify-content-center">
                {{ $GardenTools->links('pagination::bootstrap-4') }}
            </ul>
        </div>
    </div>
</section>

@endsection
