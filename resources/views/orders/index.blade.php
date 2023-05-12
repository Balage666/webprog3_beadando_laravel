@extends('main')

@section('title')
    <title>My Orders</title>
@endsection

@section('content')
<section class="min-vh-100 bg-image p-5" style="background-image: url({{ asset('/assets/media/source/ordersBackground.jpg') }});">
    <div class="container bg-dark py-5 rounded-5">

      <div class="row p-5">
          <h1 class="text-white text-center">My Orders <i class="fa-solid fa-truck-fast"></i> </h1>
      </div>

      @forelse ($Orders as $order)

      <div class="row justify-content-center mb-3">
        <div class="col-md-12 col-xl-10">
            <div class="card bg-secondary rounded-3 text-white">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">

                        {{-- <ul class="list-group">

                            <h3>Products:</h3>
                            @foreach ($order->cart->items as $cartItem)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $cartItem['item']->name }}
                                <span class="badge bg-primary badge-pill">{{ $cartItem['quantity'] }}</span>
                                <span class="badge bg-success badge-pill">{{ $cartItem['price'] }} Ft.</span>
                            </li>
                            @endforeach
                        </ul> --}}

                        <div class="d-flex flex-column mt-5">

                            <div class="btn-group">
                                <button type="button" class="btn btn-lg btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Products
                                </button>
                                <div class="dropdown-menu">
                                    @foreach ($order->cart->items as $cartItem)
                                        <a class="dropdown-item">{{ $cartItem['item']->name }} | <span class="badge bg-primary badge-pill">{{ $cartItem['quantity'] }}</span> | <span class="badge bg-success badge-pill">{{ number_format($cartItem['price'], 0, '.', ' ') }} Ft.</span> </a>
                                    @endforeach
                                </div>
                            </div>


                        </div>


                    </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 mt-4">
                            <h4> <i class="fa-solid fa-magnifying-glass"></i> Created at: {{ $order->created_at }}</h4>
                            <h5> <i class="fa-solid fa-user"></i> Customer's Full Name Given: {{ $order->first_name }} {{ $order->last_name }} </h5>
                            <h5> <i class="fa-solid fa-map-location"></i> Address: {{ $order->address }} </h5>
                            <h5> <i class="fa-solid fa-mobile-screen"></i> Phone: {{ $order->phone_number }} </h5>
                            <h5> <i class="fa-solid fa-at"></i> Email Given: {{ $order->email }} </h5>
                        </div>

                        <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start mt-4">
                            <div class="d-flex flex-row align-items-center mb-1">
                                <h4 class="mb-1 me-1"> <i class="fa-solid fa-tag"></i> Price: {{ number_format($order->cart->totalPrice, 0, '.', ' ') }} Ft.</h4>
                            </div>

                            <div class="d-flex flex-row align-items-center mb-1">
                                <h4 class="mb-1 me-1"> <i class="fa-solid fa-boxes-stacked"></i> Quantity: {{ $order->cart->totalQuantity }} </h4>
                            </div>
                            <div class="d-flex flex-column mt-5">
                                <a class="btn btn-success" href="/orders/{{ Auth::User()->id }}/refund/{{ $order->id }}"> Refund <i class="fa-solid fa-rotate-left"></i> </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

      @empty
            <h3 class="text-white text-center">Oops, Such emptiness!</h3>
      @endforelse

    <div class="row justify-content-center">
        <ul class="pagination justify-content-center">
            {{ $Orders->links('pagination::bootstrap-4') }}
        </ul>
    </div>

</section>
@endsection
