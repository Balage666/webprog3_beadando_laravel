@extends('main')

@section('title')
    <title>Sign Up</title>
@endsection

@section('content')

<section class="bg-image p-5"
      style="background-image: url({{ asset('/assets/media/source/signUpBackground.jpg') }});">
  <div class="mask d-flex align-items-center">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card bg-dark text-white rounded-5">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Please sign up</h2>

                <form action="{{ url('/sign-up') }}" method="POST">

                    @csrf

                    @error('email')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <x-form.input
                        name="email"
                        type="email"
                        label="Type your email here!"
                    />

                    @error('first_name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <x-form.input
                        name="first_name"
                        type="text"
                        label="Type your first name here!"
                    />


                    @error('last_name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <x-form.input
                        name="last_name"
                        type="text"
                        label="Type your last name here!"
                    />

                    @error('password')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <x-form.input
                        name="password"
                        type="password"
                        label="Enter your password!"
                    />

                    @error('password_confirmation')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror


                    <x-form.input
                        name="password_confirmation"
                        type="password"
                        label="Confirm your password!"
                    />

                    <div class="d-flex justify-content-center">
                        <button type="submit"class="btn btn-primary btn-block btn-lg text-white">
                            Sign Up
                        </button>
                    </div>

                    <p class="text-center text-secondary mt-5 mb-0">Already have an Account?
                        <a href="{{ url('/sign-in') }}" class="fw-bold text-body"><u class="text-white">Click here to Sign In!</u></a>
                    </p>
                </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
