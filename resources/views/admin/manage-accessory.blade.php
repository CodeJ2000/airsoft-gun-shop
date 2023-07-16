@include('admin.partials.side-header')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Manage Airsoft Accessories</h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                 
                                 
            <div class="row">
                <div class="col-lg-12">
                    @if (session('success'))
                      <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <!--    Striped Rows Table  -->
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <b>Accessory</b>
                      </div>
                      
                      <div class="panel-body">
                          <div class="table-responsive">
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Name</th> 
                                          <th>Price</th>
                                          <th>Description</th>
                                          <th>Brand</th>
                                          <th>Category</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                     @if ($products->count() > 0)
                                     @php
                                         $counter = 1;
                                     @endphp
                                         @foreach ($products as $product)
                                         <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ ucwords($product->name) }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ ucwords($product->description) }}</td>
                                            <td>{{ ucwords($product->brand->name) }}</td>
                                            <td>{{ ucwords($product->category->name) }}</td>
                                            <td class="row text-nowrap"><a href="{{ route('accessory.edit', ['id' => $product->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> <form action="{{ route('accessory.destroy', $product->id) }}" method="POST" style="display:inline;">
                                                @csrf

                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')" type="submit"><i class="fa fa-trash"></i></button>
                                                </form></td>
                                        </tr>
                                        @php
                                            $counter++;
                                        @endphp      
                                         @endforeach
                                     @endif
                                          
                                  </tbody>
                              </table>
                              <div class="text-center">
                                {{ $products->links() }}
                            </div>
                              <a href="{{ route('accessory.create') }}" class="btn btn-success">Add Product</a>
                          </div>
                      </div>
                  </div>
                  <!--  End  Striped Rows Table  -->
              </div>
            </div>
                   <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
@include('admin.partials.footer')