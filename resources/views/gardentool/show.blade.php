@extends('main')

@section('title')
    <title>View Garden Tool: {{ $gardenTool->name }}</title>
@endsection

@section('content')
<section class="min-vh-100 vh-150 bg-image p-5"
        style="background-image: url({{ asset('/assets/media/source/viewGardeningProductBackground.jpg') }});">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="card bg-dark text-white border border-5 rounded-5 {{ $gardenTool->stock == 0 ? "border-danger" : "border-info" }}">
          <img src="{{ $gardenTool->image }}"
            class="card-img-top" alt="{{ $gardenTool->name }}"  style="height: 15rem;"/>
          <div class="card-body">
            <div class="text-center">
              <h4 class="card-title">{{ $gardenTool->name }}</h4>
            </div>
            <div>
              <div class="d-flex justify-content-between">
                <h5 class="text-center">{{ $gardenTool->description }}</h5>
              </div>
              <div class="d-flex justify-content-between">
                <h5> <i class="fa-solid fa-box"></i> In Stock:</h5>

                @if ( $gardenTool->stock == 0)
                    <h5 class="badge bg-danger">Out</h5>
                @else
                    <h5 class="badge bg-info">{{ $gardenTool->stock }}</h5>
                @endif

              </div>
            </div>
            <div class="d-flex justify-content-between total font-weight-bold mt-4">
              <h5> <i class="fa-solid fa-tag"></i> Total:</h5>
              <h5>{{  $gardenTool->price }} Ft</h5>
            </div>
          </div>
            <div class="card-footer d-flex justify-content-center gap-2">
                <button onclick="history.back();" class="btn btn-secondary btn-lg">Go Back <i class="fa-solid fa-arrow-left"></i> </button>
                <a href="/cart/add/{{ $gardenTool->id }}" class="btn {{ $gardenTool->stock == 0 ? "btn-danger" : "btn-primary" }}  btn-block btn-lg">Add to Cart <i class="fa-solid fa-cart-plus"></i> </a>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
