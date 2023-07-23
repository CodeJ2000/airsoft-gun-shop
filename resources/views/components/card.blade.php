
  <div class="card">
    <img class="card-img-top" src="{{ request()->routeIs('gun.showAll') || request()->routeIs('accessory.showAll') ? '../' : ''}}storage/product_images/{{ $product->images[0]->filename }}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{ $product->price }}</h5>
      <p class="card-text">{{ $product->name }}</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">
        @if ($product instanceof App\Models\AccessoryProduct)
        <a class="btn btn-primary" href="{{ route('singleAccessory.show', ['id' => $product->id]) }}">See More</a>
      @elseif($product instanceof App\Models\GunProduct)
        <a class="btn btn-primary" href="{{ route('singleGun.show', ['id' => $product->id]) }}">See More</a>
      @endif
      </small>
    </div>
  </div>

