@extends('main')

@section('title')
    <title>Shopping Cart</title>
@endsection

@section('content')
<section class="min-vh-100 bg-image p-5"
  style="background-image: url({{ asset('/assets/media/source/shoppingCartBackground.jpg') }});">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">

            <div class="card bg-dark text-white rounded-5">
                    @if (Session::has('cart'))
                        <div class="card-body p-5">

                            <h2 class="text-uppercase text-center mb-5">Content of your Cart</h2>

                            <ul class="list-group">
                            @foreach ($CartContent as $cartItem)

                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                <p class="lead">

                                    {{ $cartItem['item']->name }}

                                </p>


                                <div class="btn-group">
                                    <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"> <span class="caret"></span> </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/cart/reducebyone/{{ $cartItem['item']->id }}">Reduce by One</a></li>
                                        <li><a class="dropdown-item" href="/cart/remove/{{ $cartItem['item']->id }}">Remove Item</a></li>
                                    </ul>
                                </div>

                                <span class="badge bg-success rounded-pill">{{ $cartItem['quantity'] }}</span>
                                <span class="badge bg-primary rounded-pill">{{ number_format($cartItem['price'], 0, '.', ' ') }} Ft.</span>
                            </li>

                            @endforeach
                            </ul>

                        </div>

                        <div class="card-footer bg-secondary d-flex align-item-center justify-content-between">
                            <strong> Order price: </strong>
                            <strong>{{ number_format($totalPrice, 0, '.', ' ') }} Ft.</strong>
                        </div>



                        <div class="d-flex justify-content-center p-3">
                            <a class="btn btn-success btn-lg" href="#">Checkout</a>
                        </div>
                    @else

                        <div class="card-body p-5">

                            <h3 class="text-center text-white">Oops, there are no items in your cart!</h3>

                        </div>
                    @endif

            </div>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection
