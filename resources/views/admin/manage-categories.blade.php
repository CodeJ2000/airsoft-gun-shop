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
                                <a class="active-menu" href="{{ route('manage.categories') }}">Manage Categories</a>
                            </li>
                            <li>
                                <a href="pricing.html">Manage Accessory Categories</a>
                            </li>
                             <li>
                                <a href="component.html">Manage Brands</a>
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
                        <h1 class="page-head-line">Manage Categories</h1>
                    </div>
                </div>
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
                                            @foreach ($gun_categories as $gun_cat)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ ucwords($gun_cat->name) }}</td>
                                                <td class="row"><a href="{{ route('updateGun.form', ['id' => $gun_cat->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                                            </tr>   
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
                                            @foreach ($accessory_categories as $accessory_cat)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ ucwords($accessory_cat->name) }}</td>
                                                <td><a href="#" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a> <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                                            </tr>   
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
    


</body>
</html>