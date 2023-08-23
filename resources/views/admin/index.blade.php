@include('admin.partials.side-header')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">DASHBOARD</h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-3 ">
                        <div class="alert alert-info text-center">
                            <i class="fa-solid fa-truck-fast fa-5x"></i>
                              <h3>{{ count($allOrders) }} Orders</h3>
                              All paid orders
                          </div>
                      </div>
                    <div class="col-md-3 ">
                        <div class="alert alert-success text-center">
                            <i class="fa-solid fa-hand-holding-dollar fa-5x"></i>
                              <h3>${{ $total }} Profits</h3>
                              Total Income
                          </div>
                      </div>
                    <div class="col-md-3 ">
                        <div class="alert alert-warning text-center">
                            <i class="fa-solid fa-users fa-5x"></i>
                              <h3>{{ count($users) }} Users</h3>
                             Customers created account
                          </div>
                      </div>
                      {{-- <div class="col-md-3 ">
                        <div class="alert alert-danger text-center">
                              <i class="fa fa-bomb fa-5x"></i>
                              <h3>30+ Issues </h3>
                              To Be Resolved Now
                          </div>
                      </div>  --}}
                </div>
                <!-- /. ROW  -->

                <div class="row">
                    <div class="col-md-8">
                            <div class="col-md-12">
                                <h3><strong>Customer's Orders</strong></h3>
                            </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Shipping Address</th>
                                        <th>Total Price</th>
                                        <th>Payment Status</th>                                        
                                        <th>Customer's name</th>
                                        <th>Order ID.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($allOrders) > 1)
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($allOrders as $order)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $order->shipping_address }}</td>
                                        <td>${{ $order->total_price }}</td>
                                        <td><span class="label label-success">{{ $order->payment_status }}</span></td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->order_id }}</td>
                                    </tr>
                                    @php
                                        $count++
                                    @endphp         
                                    @endforeach
                                    @else
                                        <div class="text-center">There are no records!</div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <div class="col-md-12">
                                <h3><strong>Customer's account</strong></h3>
                            </div>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Acount type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($users) > 0)
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($users as $user)
                                    @php
                                        $name = $user->first_name . " " . $user->last_name;         
                                    @endphp
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->user }}</td>
                                    </tr>
                                    @php
                                        $count++
                                    @endphp         
                                    @endforeach
                                    @else
                                        <div class="text-center">There are no records!</div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- /.REVIEWS &  SLIDESHOW  -->
                    <div class="col-md-4">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3>Total Income</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-body">
                                            <h1 class="text-center">${{ $total }}</h1>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/.Chat Panel End-->
                </div>
                <!-- /. ROW  -->
                <hr />
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

@include('admin.partials.footer')