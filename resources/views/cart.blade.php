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
      <h2 class="text-center">Your Cart</h2>
      <div class="tab-content">
        <div id="tab-1" class="tab-pane fade show p-0 active">
          <div class="row g-3">
            <div class="col-lg-12">
              <div class="d-flex h-100">
                <div class="flex-shrink-0">
                  <img
                    class="img-fluid"
                    src="img/gun-1.jpg"
                    alt=""
                    style="width: 150px; height: 85px"
                  />
                  <h4 class="bg-dark text-primary p-2 m-0">$99.00</h4>
                </div>
                <div
                  class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4"
                >
                  <h5 class="text-uppercase">Birthday Cake</h5>
                  <span
                    >Ipsum ipsum clita erat amet dolor sit justo sea eirmod diam
                    stet sit justo</span
                  >
                </div>
                <div class="p-3 d-flex align-items-center">
                  <a href="" class="cursor-pointer"
                    ><i class="fs-2 far fa-times-circle"></i
                  ></a>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="d-flex h-100">
                <div class="flex-shrink-0">
                  <img
                    class="img-fluid"
                    src="img/gun-1.jpg"
                    alt=""
                    style="width: 150px; height: 85px"
                  />
                  <h4 class="bg-dark text-primary p-2 m-0">$99.00</h4>
                </div>
                <div
                  class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4"
                >
                  <h5 class="text-uppercase">Birthday Cake</h5>
                  <span
                    >Ipsum ipsum clita erat amet dolor sit justo sea eirmod diam
                    stet sit justo</span
                  >
                </div>
                <div class="p-3 d-flex align-items-center">
                  <a href="" class="cursor-pointer"
                    ><i class="fs-2 far fa-times-circle"></i
                  ></a>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="d-flex h-100">
                <div class="flex-shrink-0">
                  <img
                    class="img-fluid"
                    src="img/gun-1.jpg"
                    alt=""
                    style="width: 150px; height: 85px"
                  />
                  <h4 class="bg-dark text-primary p-2 m-0">$99.00</h4>
                </div>
                <div
                  class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4"
                >
                  <h5 class="text-uppercase">Birthday Cake</h5>
                  <span
                    >Ipsum ipsum clita erat amet dolor sit justo sea eirmod diam
                    stet sit justo</span
                  >
                </div>
                <div class="p-3 d-flex align-items-center">
                  <a href="" class="cursor-pointer"
                    ><i class="fs-2 far fa-times-circle"></i
                  ></a>
                </div>
              </div>
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
              value="Start here.."
            />
            <label for="floatingInputGrid"
              >Enter special delivery instruction note...</label
            >
          </div>
        </div>
      </form>
      <hr />
      <div class="subtotal">
        <div class="total">
          <h3>Subtotal</h3>
          <h2 class="total-price">&#8369; 4000</h2>
        </div>
        <a href="" class="btn btn-primary py-2 px-5 me-5 mb-3">CheckOut</a>
      </div>
    </div>
    <!-- Cart end -->
    <!-- Footer Start -->
@include('partials.footer')