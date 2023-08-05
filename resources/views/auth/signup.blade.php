<x-base-layout>
      <!-- Hero Start -->
      <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
          <div class="row justify-content-start">
            <div class="col-lg-8 text-center text-lg-start">
              <h1 class="text-uppercase text-white mb-5">Customer Register</h1>
              @if ($errors->any())
              <div class="alert alert-danger col-md-8 rounded">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              <form class="col-md-8" action="{{ route('signup') }}" method="POST">
                @csrf
                <div class="col-md-12 d-flex gap-2">
                  <div class="input-group mb-4">
                    <input
                      type="text"
                      name="first_name"
                      value="{{ old('first_name') }}"
                      class="form-control border-white p-3"
                      placeholder="Your first name"
                    />
                  </div>
                  <div class="input-group mb-4">
                    <input
                      type="text"
                      name="last_name"
                      value="{{ old('last_name') }}"
                      class="form-control border-white p-3"
                      placeholder="Your last name"
                    />
                  </div>
                </div>
                <div class="input-group mb-4">
                  <input
                    type="text"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control border-white p-3"
                    placeholder="Your Email"
                  />
                </div>
                <div class="input-group mb-4">
                  <input
                    type="password"
                    name="password"
                    class="form-control border-white p-3"
                    placeholder="Your Password"
                  />
                </div>
                <div class="input-group mb-4">
                  <input
                    type="password"
                    name="password_confirmation"
                    class="form-control border-white p-3"
                    placeholder="Your Confirm password"
                  />
                </div>
                <div class="mb-2">
                  Do you want to login?
                  <a href="login.html">Click here</a>
                </div>
                <input
                  type="submit"
                  value="Signup"
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
  
</x-base-layout>