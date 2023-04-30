@extends('main')

@section('title')
    <title>Sign In</title>
@endsection

@section('content')
<section class="bg-image p-5"
  style="background-image: url({{ asset('/assets/media/source/signInBackground.jpg') }});">
  <div class="mask d-flex align-items-center h-100">
    <div class="container">
      <div class="row d-flex justify-content-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card bg-dark text-white rounded-5">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Please sign in</h2>

              <form action="{{ url('/sign-in') }}" method="post">

                @csrf

                @error('email')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror

                <x-form.input
                    name="email"
                    type="email"
                    label="Type your email!"
                />

                @error('password')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror

                <x-form.input
                    name="password"
                    type="password"
                    label="Type your password!"
                />

                <div class="d-flex justify-content-center">
                  <button type="submit"
                    class="btn btn-primary btn-block btn-lg gradient-custom-4 text-white">Sign In</button>
                </div>

                <p class="text-center text-secondary mt-5 mb-0">Don't have an Account?
                    <a href="{{ url('/sign-up') }}" class="fw-bold text-body"><u class="text-white">Click here to Sign Up!</u></a>
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
