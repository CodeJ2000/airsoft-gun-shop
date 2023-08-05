<div class="container-fluid px-0 d-none d-lg-block">
    <div class="row gx-0">
      <div class="col-lg-4 text-center bg-secondary py-3">
        <div class="d-inline-flex align-items-center justify-content-center">
          <i class="bi bi-envelope fs-1 text-primary me-3"></i>
          <div class="text-start">
            <h6 class="text-uppercase mb-1">Email Us</h6>
            <span>info@example.com</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4 text-center bg-primary border-inner py-3">
        <div class="d-inline-flex align-items-center justify-content-center">
          <a href="index.html" class="navbar-brand">
            <h1 class="m-0 text-uppercase text-white">
              <i class="fa fa-rifle fs-1 text-dark me-3"></i>Airsoft Zone
            </h1>
          </a>
        </div>
      </div>
      <div class="col-lg-4 text-center bg-secondary py-3">
        <div class="d-inline-flex align-items-center justify-content-center">
          <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
          <div class="text-start">
            <h6 class="text-uppercase mb-1">Call Us</h6>
            <span>+012 345 6789</span>
          </div>
        </div>
      </div>
    </div>
  </div>

<nav
class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0"
>
<a href="index.html" class="navbar-brand d-block d-lg-none">
  <h1 class="m-0 text-uppercase text-white">
    <i class="fa fa-birthday-cake fs-1 text-primary me-3"></i>CakeZone
  </h1>
</a>
<button
  class="navbar-toggler"
  type="button"
  data-bs-toggle="collapse"
  data-bs-target="#navbarCollapse"
>
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
  <div class="navbar-nav ms-auto mx-lg-auto py-0">
    <a href="{{ route('main') }}" class="nav-item nav-link active">Home</a>
    <a href="about.html" class="nav-item nav-link">About Us</a>
    <div class="nav-item dropdown">
      <a
        href="#"
        class="nav-link dropdown-toggle"
        data-bs-toggle="dropdown"
        >Airsoft Guns</a
      >

      <div class="dropdown-menu m-0">
        @if ($guns)
          @foreach ($guns as $gun)
          <a href="{{ route('gun.showAll', ['id' => $gun->id]) }}" class="dropdown-item">{{ ucwords($gun->name) }}</a>
          @endforeach
        @else
          <p class="text-center text-muted">Empty</p>
        @endif
      </div>
    </div>
    <div class="nav-item dropdown">
      <a
        href="#"
        class="nav-link dropdown-toggle"
        data-bs-toggle="dropdown"
        >Accessories</a
      >
      <div class="dropdown-menu m-0">
        @if($accessories)
        @foreach ($accessories as $accessory)
        <a href="{{ route('accessory.showAll', ['id' => $accessory->id]) }}" class="dropdown-item">{{ ucwords($accessory->name) }}</a>
        @endforeach
        @endif
      </div>
    </div>
    @guest
    <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
    @endguest
    @auth
    @if (auth()->user()->isCustomer())
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-item nav-link">Logout</a>
    <form action="{{ route('logout') }}" id="logout-form" method="POST">
      @csrf
    </form>
    <a href="{{ route('cart') }}" class="nav-item nav-link"
    ><i class="fa fa-shopping-cart"></i>
    @if (auth()->check())
      @php
        $items = auth()->user()->cart->cartItems()->whereNull('order_id')->get()
      @endphp
      <sup class="text-danger">{{ $items->count() }}</sup>
    @endif
    </a
  >
  <a href="{{ route('orders') }}" class="nav-item nav-link"
  >Orders
  @if (auth()->check())
    @php
      $items = auth()->user()->orders;
    @endphp
    <sup class="text-danger">{{ $items->count() }}</sup>
  @endif
  </a
>  
    @endif
    @endauth
  </div>
</div>
</nav>