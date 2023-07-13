<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Dashboard</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="{{ url('admin-assets/css/bootstrap.css') }}" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{ url('admin-assets/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES -->

    <link href="{{ url('css/admin-css/bootstrap-fileupload.min.css') }}" rel="stylesheet" />

       <!--CUSTOM BASIC STYLES-->
    <link href="{{ url('admin-assets/css/basic.css') }}" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="{{ url('admin-assets/css/custom.css') }}" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Airsoft Zone</a>
            </div>
{{-- 
            <div class="header-right">

                <a href="message-task.html" class="btn btn-info" title="New Message"><b>30 </b><i class="fa fa-envelope-o fa-2x"></i></a>
                <a href="message-task.html" class="btn btn-primary" title="New Task"><b>40 </b><i class="fa fa-bars fa-2x"></i></a>
                <a href="login.html" class="btn btn-danger" title="Logout">Lagout</a>

            </div> --}}
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src="assets/img/user.png" class="img-thumbnail" />

                            <div class="inner-text">
                                Jhon Deo Alex
                            <br />
                                <small>Last Login : 2 Weeks Ago </small>
                            </div>
                        </div>

                    </li>


                    <li>
                        <a class="active-menu" href="index.html"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="active-menu-top"><i class="fa fa-desktop "></i>Product Management <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level collapse in">
                            <li>
                                <a class="active-menu" href="{{ route('manage.gun') }}">Manage Guns</a>
                            </li>
                            <li>
                                <a href="notification.html"></i>Manage Accessories</a>
                            </li>
                        </ul>
                    </li>
                     <li>
                        <a href="#" ><i class="fa fa-yelp "></i>Categories and Brands <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a class="{{ request()->routeIs('manageGun.categories-form') ||request()->routeIs('manageAccessory.categories-form') || request()->routeIs('updateGun.form') || request()->routeIs('updateAccessory.form') ? 'active-menu' : ''}}"  href="{{ route('manage.categories') }}">Manage Categories</a>
                            </li>
                             <li>
                                <a class="{{ request()->routeIs('brand.create') ? 'active-menu' : ''}}" href="{{ route('manage.brands') }}">Manage Brands</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="table.html">Orders Management</a>
                    </li>
                    <li>
                        <a href="table.html">Customers Management</a>
                    </li>
                    <li>
                        <a href="table.html">Reports and Analytics</a>
                    </li>
                    <li>
                        <a href="table.html">Settings</a>
                    </li>
                    <li>
                        <a href="table.html">Lagout</a>
                    </li>
                </ul>
            </div>

        </nav>
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
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                                 <div class="panel-heading">
                                    <strong>{{ $subHeader }}</strong>
                                 </div>
                                 <div class="panel-body">
                                     <form role="form" method="POST" action="{{ isset($product) ? route('gun.update', $product->id) : route('gun.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        @if (isset($product))
                                            @method('PUT')
                                        @endif
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <label for="name">Name:</label>
                                                     <input class="form-control" name="name" value="{{ old('name', isset($product) ? $product->name : '') }}" type="text">
                                                 </div>
                                                 <div class="form-group">
                                                    <label for="name">Price:</label>
                                                     <input class="form-control" value="{{ old('price', isset($product) ? $product->price : '') }}" name="price" type="text">
                                                 </div>
                                                 <div class="form-group">
                                                    <label>Description:</label>
                                                    <textarea name="description" class="form-control" rows="3">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Select Brand</label>
                                                    <select name="brand_id" class="form-control">
                                                        <option value="">Select a Brand...</option>
                                                        
                                                        @if ($brands->count() > 0)
                                                        @foreach ($brands as $brand)
                                                            <option value="{{ $brand->id }}" {{ old('brand_id', (isset($product) && $product->brand_id == $brand->id) ? 'selected' : '') }}>
                                                                {{ ucwords($brand->name) }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                    
                                                    </select>
                                                </div>
                          
                                                <div class="form-group">
                                                    <label>Select Category</label>
                                                    <select name="category_id" class="form-control">
                                                        <option value="">Select a Category...</option>
                                                        
                                                        @if ($categories->count() > 0)
                                                            @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" {{ old('category_id', isset($product) && $product->category_id == $category->id ?  "selected" : "") }}>{{ ucwords($category->name) }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Image1 Upload</label>
                                                    <div class="">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                                                            <div>
                                                                <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="images[]"></span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Image2 Upload</label>
                                                    <div class="">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                                                            <div>
                                                                <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="images[]"></span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Image3 Upload</label>
                                                    <div class="">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                                                            <div>
                                                                <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="images[]"></span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Image4 Upload</label>
                                                    <div class="">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                                                            <div>
                                                                <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="images[]"></span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center col-md-12">
                                                 <button type="submit" class="btn btn-info ">Add product</button>
                                                 <a href="{{ route('manage.gun') }}" class="btn btn-muted">Back</a>
                                            </div>
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
    <div id="footer-sec">
        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
    </div>
        <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="{{ url('admin-assets/js/jquery-1.10.2.js') }}"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{ url('admin-assets/js/bootstrap.js') }}"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="{{ url('admin-assets/js/jquery.metisMenu.js') }}"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="{{ url('admin-assets/js/custom.js') }}"></script>
    
    <script src="{{ url('admin-assets/js/bootstrap-fileupload.js') }}"></script>

</body>
</html>
