@extends('main')

@section('title')
    <title>Checkout</title>
@endsection

@section('content')
{{-- <h1>{{ dd($Cart) }}</h1> --}}

<section class="min-vh-100 vh-125 bg-image p-5" style="background-image: url({{ asset('/assets/media/source/buyProductBackground.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="card bg-dark text-white mb-4 rounded-5">
                <div class="card-header py-3">
                    <h2 class="text-uppercase text-center mb-0">Billing details</h2>
                </div>
                    <div class="card-body">

                        <form action="/cart/checkout/{{ $Cart->totalPrice }}" method="post">

                            @csrf

                            @error('first_name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <x-form.input
                                name="first_name"
                                label="First Name:"
                                placeholder="Jenő"
                                value="{{ Auth::User() ? Auth::User()->first_name : '' }}"
                            />

                            @error('last_name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <x-form.input
                                name="last_name"
                                label="Last Name:"
                                placeholder="Horváth"
                                value="{{ Auth::User() ? Auth::User()->last_name : '' }}"
                            />

                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <x-form.input
                                name="email"
                                type="email"
                                label="Email:"
                                placeholder="horvath.jeno@vektor.hu"
                                value="{{ Auth::User() ? Auth::User()->email : '' }}"
                            />

                            @error('address')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <x-form.input
                                name="address"
                                label="Address:"
                                placeholder="201, Bádogdorog, Mocskos Ferenc utca 6."
                            />

                            @error('phone_number')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <x-form.input
                                name="phone_number"
                                type="tel"
                                label="Telephone:"
                                placeholder="703452397"
                            />

                            <x-form.textarea :isRequired="false"
                                name="additional_information"
                                label="Additional information (optional):"
                                rows="6"
                                placeholder="Sample Description"
                            />

                            <div class="d-flex justify-content-center gap-2">


                                <button onclick="history.back();"
                                    class="btn btn-secondary btn-lg text-white">Go Back <i class="fa-solid fa-arrow-left"></i> </button>


                                <button type="submit"
                                    class="btn btn-primary btn-block btn-lg gradient-custom-4 text-white">Make Purchase <i class="fa-solid fa-cash-register"></i> </button>

                            </div>

                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card bg-dark text-white mb-4 rounded-5">
                <div class="card-header py-3">
                    <h2 class="text-uppercase text-center mb-0">Summary</h2>
                </div>
                    <div class="card-body">

                        @if ($Cart)

                        @foreach ($Cart->items as $cartItem)

                            <div class="d-flex justify-content-between">
                                <h5> <i class="fa-solid fa-magnifying-glass"></i> Name:</h5>
                                <h5><span>{{ $cartItem['item']->name }}</span></h5>
                            </div>

                            <div class="d-flex justify-content-between">
                                <h5> <i class="fa-solid fa-boxes-stacked"></i> Quantity:</h5>
                                <h5><span>( {{ $cartItem['quantity'] }} x )</span></h5>
                            </div>

                            <div class="d-flex justify-content-between">
                                <h5> <i class="fa-solid fa-tag"></i> Price:</h5>
                                <h5><span>{{ number_format($cartItem['item']->price, 0, '.', ' ') }} Ft.</span></h5>
                            </div>

                            <hr>

                        @endforeach

                        <div class="d-flex justify-content-between">
                            <h5> <i class="fa-solid fa-tags"></i> Total Cost:</h5>
                            <h5><span>{{ number_format($Cart->totalPrice, 0, '.', ' ') }} Ft.</span></h5>
                        </div>

                        @else

                        <div class="d-flex justify-content-between">
                            <h5>How did you get here without products?</h5>
                        </div>

                        @endif


                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

@endsection
