@if (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<x-base-layout>
  <!-- Cart start -->
  <div class="container pt-4">
    <div class="tab-content">
      <div id="tab-1" class="tab-pane fade show p-0 active">
        <div class="row g-3">
          <div class="container">
            <h1>Order list</h1>
            <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Order ID</th>
                      <th>Shipping Address</th>
                      <th>Total Price</th>
                      <th>Date of order</th>
                      <th class="no-wrap">Payment Status</th>
                  </tr>
              </thead>
              <tbody>
                @if($orders->count() > 0)
                  @foreach ($orders as $order)
                  @php
                    $address = $order->user->cart->shippingAddress;
                    $shippingAddress = $address->street . " " . "Brgy. " . $address->barangay . " " .  $address->city . " " . $address->province . " " . $address->zip_code;
                  @endphp
                      <tr class="orderRow"  style="cursor: pointer;" data-order-id="{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <td class="align-middle col-sm-1">{{ $order->id }}</td>
                          <td class="align-middle col-sm-5">{{ ucwords($shippingAddress) }}</td>
                          <td class="align-middle col-sm-2">${{ $order->total_price }}</td>
                          <td class="align-middle col-sm-2">{{ $order->formatted_created }}</td>
                          <td class="align-middle col-sm-2">{{ ucwords($order->status) }}</td>
                      </tr>        
                  @endforeach
                @endif
              </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <table id="orderTable" class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            {{-- <tr>
              
              <td class="align-middle">
                    <img src="storage/product_images/"  width="200px" alt="">
                <div class="media-body">
                  <h4 class="media-heading"><a href="">sada</a></h4>
               </div>
                </div>
              </td>
              <td class="align-middle">&#8369; 223</td>
              <td class="align-middle col-sm-2">2</td>
              <td class="align-middle">&#8369; 32</td>
          </tr> --}}
        </tbody>
    </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary">Save changes</button>
    </div>
  </div>
</div>
</div>
  <!-- Cart end -->

  @push('scripts')
    <script>
      $(document).ready(function(){
        $('.orderRow').click(function(){
          let orderId = $(this).data('order-id');

          $.ajax({
            url: '{{ route("order.products", ["orderId" => "__orderId__"]) }}'.replace('__orderId__', orderId),
            type: 'GET',
            dataType: 'json',
            success: function(response){
              $('#orderTable tbody').empty();
              console.log(response.products);
              $.each(response.products, function(index, product){
                let row =
                  '<tr>' + 
                  '<td class="align-middle"><img src="' + product.filename + '"  width="100px" alt=""> <div class="media-body"><h4>'+ product.name +'</h4></div></td>' +
                  '<td class="align-middle">$' + product.price + '</td>' +
                  '<td class="align-middle">' + product.quantity + '</td>' +
                  '<td class="align-middle">$' + product.sub_total + '</td>' +
                  '</tr>';
                  $('#orderTable tbody').append(row);
              })
            }
          })
        })
      })
    </script>
  @endpush
</x-base-layout>