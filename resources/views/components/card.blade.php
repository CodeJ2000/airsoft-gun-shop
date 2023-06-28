<div class="col-lg-6">
                    <a href="{{ route('singleGun.show', ['id' => $product->id]) }}">
                      <div class="d-flex h-100">
                        <div class="flex-shrink-0">
                          <img
                            class="img-fluid"
                            src="{{ url('img/sniper.jpg') }}"
                            alt=""
                            style="width: 150px; height: 85px"
                          />\
                          <h4 class="bg-dark text-primary p-2 m-0 h5">&#8369; {{ $product->price }}</h4>
                        </div>
                        <div
                          class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4"
                        >
                        <h5 class="text-uppercase h5">{{ $product->name }}</h5>
                          <span
                            > Brand: <strong>{{ $product->brand->name }}</strong></span
                          >
            </div>
        </div>
    </a>
</div>