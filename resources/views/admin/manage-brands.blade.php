@include('admin.partials.side-header')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Manage Brands</h1>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
                @php
                    session()->forget('success')
                @endphp
                @endif

                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-6">
                          <!--    Striped Rows Table  -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Brands</b>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($brands->count() > 0)
                                            @php
                                                $counter = 1;
                                            @endphp
                                                @foreach ($brands as $brand)
                                                <tr>
                                                    <td>{{ $counter }}</td>
                                                    <td>{{ $brand->name }}</td>
                                                    <td class="row"><a href="{{ route('brand.edit',['id' => $brand->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> <form action="{{ route('brand.destroy', ['id' => $brand->id]) }}" method="POST" style="display:inline;">
                                                        @csrf
        
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this  category')" type="submit"><i class="fa fa-trash"></i></button>
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
                                        {{ $brands->links() }}
                                    </div>
                                    <a href="{{ route('brand.create') }}" class="btn btn-success">Add Brand</a>
                                </div>
                            </div>
                        </div>
                        <!--  End  Striped Rows Table  -->
                    </div>
                </div>
                   <!-- /. ROW  -->
            <div class="row">
                
            </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
@include('admin.partials.footer')