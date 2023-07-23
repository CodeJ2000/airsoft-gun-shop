@include('partials.header')
    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
      <div class="container py-5">
        <div class="row justify-content-start">
          <div class="col-lg-8 text-center text-lg-start">
            <h1 class="text-uppercase text-white mb-5">Shipping Address</h1>
            @if ($errors->any())
            <div class="alert alert-danger col-md-8 rounded">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            <form class="col-md-8" action="{{ route('address.store') }}" method="POST">
              @csrf
              <div class="col-md-12 d-flex gap-2">
                <div class="input-group mb-4">
                  <input
                    type="text"
                    name="street"
                    value="{{ old('street') }}"
                    class="form-control border-white p-3"
                    placeholder="Street"
                  />
                </div>
                <div class="input-group mb-4">
                  <input
                    type="text"
                    name="barangay"
                    value="{{ old('barangay') }}"
                    class="form-control border-white p-3"
                    placeholder="Barangay"
                  />
                </div>
              </div>
              <div class="col-md-12 d-flex gap-2">
                <div class="input-group mb-4">
                  <input
                    type="text"
                    name="city"
                    value="{{ old('city') }}"
                    class="form-control border-white p-3"
                    placeholder="City"
                  />
                </div>
                <div class="input-group mb-4">
                  <input
                    type="text"
                    name="zip_code"
                    value="{{ old('last_name') }}"
                    class="form-control border-white p-3"
                    placeholder="Zip Code"
                  />
                </div>
              </div>
              <div class="input-group mb-4">
                <input
                  type="text"
                  name="province"
                  value="{{ old('province') }}"
                  class="form-control border-white p-3"
                  placeholder="Province"
                />
              </div>
              <div class="mb-2">
                <input
                  type="submit"
                  value="Submit"
                  class="btn btn-primary border-inner py-3 px-5 me-5"
                />
                <a href="login.html">Go back</a>
              </div>
            </form>
            <div
              class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5"
            ></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Hero End -->

@include('partials.footer')