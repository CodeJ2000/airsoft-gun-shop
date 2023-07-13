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
                        <a href="#" class=""><i class="fa fa-desktop "></i>Product Management <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('manage.gun') }}">Manage Guns</a>
                            </li>
                            <li>
                                <a href="notification.html"></i>Manage Accessories</a>
                            </li>
                        </ul>
                    </li>
                     <li>
                        <a href="#" class="active-menu-top"><i class="fa fa-yelp "></i>Categories and Brands <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level collapse in">
                            <li>
                                <a  href="{{ route('manage.categories') }}">Manage Categories</a>
                            </li>
                             <li>
                                <a class="active-menu" href="{{ route('manage.brands') }}">Manage Brands</a>
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
    <script>
        $(document).ready(function(){
            const $successMessage = $('#success-message');

            if($successMessage.length){
                setTimeout(() => {
                    $successMessage.fadeOut();
                }, 3000);
            }
        });        
    </script>

</body>
</html>
