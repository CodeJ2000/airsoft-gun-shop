@include('partials.header')
    <!-- Navbar End -->

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
      <div class="container py-5">
        <div class="row justify-content-start">
          <div class="col-lg-8 text-center text-lg-start">
            <h1 class="text-uppercase text-white mb-5">Customer Login</h1>
            @if ($errors->has('email'))
              <div class="alert alert-danger col-md-6 rounded">
                {{ $errors->first('email') }}
              </div>
            @endif
            <form class="col-md-6" action="{{ route('login.auth') }}" method="POST">
              @csrf
              <div class="input-group mb-4">
                <input
                  type="text"
                  name="email"
                  class="form-control border-white p-3"
                  placeholder="Your Email"
                />
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="input-group mb-4">
                <input
                  type="password"
                  name="password"
                  class="form-control border-white p-3"
                  placeholder="Your Password"
                />
              </div>
              <div class="mb-2">
                Don't have an account?
                <a href="{{ route('signup.view') }}">Signup</a>
              </div>
              <input
                type="submit"
                value="Login"
                class="btn btn-primary border-inner py-3 px-5 me-5"
              />
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