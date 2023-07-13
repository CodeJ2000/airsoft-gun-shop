
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
    <!-- Single product start -->
    <div class="container-fluid d-lg-flex mt-4 gap-3">
      <div class="col-lg-4 ">
        <img id="mainImage" class="img-fluid w-100 pb-1 border" src="{{ url('storage/product_images/' . $singleProduct->images[0]->filename) }}" alt="" />
        <div class="small-img-group d-flex">
          <div class="small-img-col p-1 border">
            <img src="{{ url('storage/product_images/' . $singleProduct->images[0]->filename) }}" width="100%" class="class-img " alt="" onclick="changeImage(this)"/>
          </div>
          <div class="small-img-col p-1 border">
            <img src="{{ url('storage/product_images/' . $singleProduct->images[1]->filename) }}" width="100%" class="class-img " alt="" onclick="changeImage(this)" />
          </div>
          <div class="small-img-col p-1 border">
            <img src="{{ url('storage/product_images/' . $singleProduct->images[2]->filename) }}" width="100%" class="class-img " alt="" onclick="changeImage(this)"/>
          </div>
          <div class="small-img-col p-1 border">
            <img src="{{ url('storage/product_images/' . $singleProduct->images[3]->filename) }}" width="100%" class="class-img " alt="" onclick="changeImage(this)"/>
          </div>
        </div>
      </div>
      <div class="col-lg-5 col-md-10 col-10">
        <h3 class="mb-4">
          {{ $singleProduct->name }}
        </h3>
        <a href="" class="btn btn-primary py-2 px-5 me-5 mb-3"
          ><i class="fa fa-sharp fa-heart pe-2"></i>Add to Wishlist</a
        >
        <h6 class="mb-4">BY <strong class="h4">{{ ucwords($brandName) }}</strong></h6>
        <h5 class="mb-4">
          Price: <s class="text-muted">&#8369; {{ $singleProduct->price }}</s>
          <span class="text-primary"> &#8369; {{ $singleProduct->price }}</span>
        </h5>
        <h5 class="text-primary">Product Description:</h5>
        <p>
          {{ $singleProduct->description }}
        </p>
      </div>
      <div class="col-lg-3"><h1>Payment section</h1></div>
    </div>
    <!-- Single product end -->
    <script>
      function changeImage(img){
        const mainImage = document.getElementById('mainImage');
        mainImage.src = img.src
      }
    </script>
    @include('partials.footer')