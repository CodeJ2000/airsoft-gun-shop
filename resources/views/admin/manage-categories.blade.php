@include('admin.partials.side-header')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Manage Categories</h1>
                    </div>
                </div>
                @if (session('success'))
                    <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-6">
                          <!--    Striped Rows Table  -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Gun Categories</b>
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
                                            @if($gun_categories->count() > 0)
                                            @php
                                                $counter = 1;
                                            @endphp
                                            @foreach ($gun_categories as $gun_cat)
                                            <tr>
                                                <td>{{ $counter }}</td>
                                                <td>{{ ucwords($gun_cat->name) }}</td>
                                                <td class="row"><a href="{{ route('updateGun.form', ['id' => $gun_cat->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> <form action="{{ route('gun-categories.destroy', ['id' => $gun_cat->id]) }}" method="POST" style="display:inline;">
                                                    @csrf
    
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this {{ ucwords($gun_cat->name) }} category')" type="submit"><i class="fa fa-trash"></i></button>
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
                                        {{ $gun_categories->links() }}
                                    </div>
                                    <a href="{{ route('manageGun.categories-form') }}" class="btn btn-success">Add category</a>
                                </div>
                            </div>
                        </div>
                        <!--  End  Striped Rows Table  -->
                    </div>
                    <div class="col-md-6">
                        <!--    Bordered Table  -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Accessory Categories</b>
                            </div>
                            <!-- /.panel-heading -->
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
                                            @if($accessory_categories->count() > 0)
                                            @php
                                                $counter = 1;
                                            @endphp
                                            @foreach ($accessory_categories as $accessory_cat)
                                            <tr>
                                                <td>{{ $counter }}</td>
                                                <td>{{ ucwords($accessory_cat->name) }}</td>
                                                <td><a href="{{ route('updateAccessory.form', ['id' => $accessory_cat->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> <form method="POST" action="{{ route('accessory-categories.destroy', ['id' => $accessory_cat->id]) }}" style="display: inline;">
                                                @csrf

                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete {{ ucwords($accessory_cat->name) }} category')" type="submit"><i class="fa fa-trash"></i></button>
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
                                    {{ $accessory_categories->links() }}
                                    </div>
                                    <a href="{{ route('manageAccessory.categories-form') }}" class="btn btn-success">Add category</a>
                                </div>
                            </div>
                        </div>
                         <!--  End  Bordered Table  -->
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