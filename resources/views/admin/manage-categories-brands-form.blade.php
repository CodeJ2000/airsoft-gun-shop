@include('admin.partials.side-header')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">{{ $header }}</h1>
                    </div>
                </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>    
                        @endif
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-info">
                                 <div class="panel-heading">
                                    <strong>{{ ucwords($subHeader) }}</strong>
                                 </div>
                                 <div class="panel-body">
                                     <form role="form" method="POST" action="{{ isset($dataFound) ? route($routeName, ['id' => $dataFound->id]) : route($routeName) }}">
                                        @csrf
                                                 <div class="form-group">
                                                     <input class="form-control" value="{{ isset($dataFound) ? ucwords($dataFound->name) : ''}}" name="name" type="text">
                                                 </div>
                                                 <button type="submit" class="btn btn-info">Submit</button>
                                                 <a href="{{ route($redirectTo) }}" class="btn btn-muted">Back</a>
                                             </form>
                                     </div>
                                 </div>
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