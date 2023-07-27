@if (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
@include('partials.header')
<style>
      .small-img-group {
        display: flex;
        justify-content: space-between;
      }
      .small-img-col {
        flex-basis: 24%;
        cursor: pointer;
      }
    </style>
    <!-- Cart start -->
    <div class="container pt-4">
      <div class="tab-content">
        <div id="tab-1" class="tab-pane fade show p-0 active">
          <div class="row g-3">
            <div class="container">
              <h1>Shopping Cart</h1>
              <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if($cartItems->count() > 0)
                    @foreach ($cartItems as $cartItem)
                    <tr>
                      @php
                        $image = $cartItem->productable->images->first()->filename
                      @endphp
                      <td class="align-middle">
                            <img src="storage/product_images/{{ $image }}"  width="200px" alt="">
                        <div class="media-body">
                          <h4 class="media-heading"><a href="">{{ $cartItem->productable->name }}</a></h4>
                          <span>Status:</span>
                          @if ($cartItem->productable->stock < 1)
                          <span class="text-da">
                            Out of Stock
                          </span>
                          @else
                          <span class="text-success">
                            In Stock
                          </span>
                          @endif
                        </div>
                        </div>
                      </td>
                      <td class="align-middle">&#8369; {{ $cartItem->price }}</td>
                      <td class="align-middle col-sm-2">{{ $cartItem->quantity }}</td>
                      <td class="align-middle">&#8369; {{ $cartItem->total_price }}</td>
                      <td class="align-middle">
                        <form action="{{ route('cartItem.destroy', ['id' => $cartItem->id]) }}" style="display: inlinel" method="POST">
                        @csrf

                        @method('DELETE')

                        <button type="submit" onclick="return confirm('Are you sure you want to remove?')" class="btn btn-danger btn-sm cart-remove" data-key="">Remove</button>
                        </form>
                      </td>
                  </tr>
                    @endforeach
                  @endif
                </tbody>
            </table>
          </div>
            
          </div>
        </div>
      </div>
      <hr />
      <form action="">
        <div class="col-md">
          <div class="form-floating">
            <input
              type="email"
              class="form-control"
              id="floatingInputGrid"
              placeholder="name@example.com"
              value="{{ $shippingAddress }}"
              readonly
            />
            <label for="floatingInputGrid"
              >Your shipping address...</label
            >
            <a href="{{ route('address.index') }}" class="btn btn-primary mt-2">Edit address</a>
          </div>
        </div>
      </form>
      <hr />
      <div class="subtotal">
        <div class="total">
          <h3>Total Price</h3>
          <h2 class="total-price">&#8369; {{ $totalPrice }}</h2>
        </div>
        <form action="{{ route('checkout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary py-2 px-5 me-5 mb-3">Checkout</button>
          <a href="{{ Session::get('previous_url') }}" class="btn btn-success py-2 px-5 me-5 mb-3">Continue Shopping</a>
        </form>
        
      </div>
    </div>
    <!-- Cart end -->
    <!-- Footer Start -->
@include('partials.footer')