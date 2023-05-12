@extends('main')

@section('title')
    <title>Create new Gardening Tool!</title>
@endsection

@section('content')

<section class="min-vh-100 bg-image p-5"
  style="background-image: url({{ asset('/assets/media/source/newGardeningToolBackground.jpg') }});">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card bg-dark text-white rounded-5">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create new Gardening Tool</h2>

              <form action="{{ url('/gardentool/store') }}" method="post" enctype="multipart/form-data">

                @csrf

                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror

                <x-form.input
                        name="name"
                        label="Give Name:"
                        placeholder="Market Gardener"
                />

                <x-form.textarea :isRequired="false"
                    name="description"
                    label="Write Description:"
                    rows="6"
                    placeholder="Sample Description"
                />

                @error('stock')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror

                <x-form.input
                        name="stock"
                        label="Define quantity:"
                        type="number"
                        placeholder="99"
                />


                @error('price')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror

                <x-form.input
                        name="price"
                        label="Enter Price in HUF:"
                        type="number"
                        placeholder="500"
                />

                <x-form.input :isRequired="false"
                    name="image"
                    label="Set Image:"
                    type="file"
                />

                <div class="d-flex justify-content-center gap-2">

                    <button onclick="history.back();"
                        class="btn btn-secondary btn-lg text-white">Back to Storefront <i class="fa-solid fa-arrow-left"></i> </button>

                    <button type="submit"
                        class="btn btn-primary btn-block btn-lg gradient-custom-4 text-white">Create <i class="fa-solid fa-square-plus"></i> </button>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
