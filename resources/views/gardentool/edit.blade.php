@extends('main')

@section('title')
    <title>Update details of Gardening Tool!</title>
@endsection

@section('content')

<section class="min-vh-100 bg-image p-5"
  style="background-image: url({{ asset('/assets/media/source/updateGardeningToolBackground.jpg') }});">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card bg-dark text-white rounded-5">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Update Gardening Tool</h2>


                <form action="{{ url('/gardentool/update/'.$gardenTool->id) }}" method="post" enctype="multipart/form-data">

                    @csrf

                    @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <x-form.input
                        name="name"
                        label="Update Name:"
                        value="{{ $gardenTool->name }}"
                    />

                    <x-form.textarea :isRequired="false"
                        name="description"
                        label="Update Description:"
                        rows="6"
                        :value="$gardenTool->description"
                    />

                    @error('stock')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <x-form.input
                        name="stock"
                        type="number"
                        label="Edit Quantity:"
                        value="{{ $gardenTool->stock }}"
                    />

                    @error('price')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <x-form.input
                        name="price"
                        type="number"
                        label="Edit Price in HUF:"
                        value="{{ $gardenTool->price }}"
                    />

                    @error('image')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <x-form.input :isRequired="false"
                        name="image"
                        type="file"
                        label="Edit Image:"
                    />
                    <div class="d-flex justify-content-center gap-2">
                        <button onclick="history.back();"
                            class="btn btn-secondary btn-lg text-white">Back to Storefront <i class="fa-solid fa-arrow-left"></i> </button>

                        <button type="submit"
                            class="btn btn-primary btn-block btn-lg gradient-custom-4 text-white">Update <i class="fa-solid fa-wrench"></i> </button>

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
