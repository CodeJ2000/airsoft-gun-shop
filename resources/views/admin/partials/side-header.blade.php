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
    <link href="{{ url('css/admin-css/bootstrap-fileupload.min.css') }}" rel="stylesheet" />

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

                    @php
                    $isActiveDashboard = request()->routeIs('admin.dashboard');
                    $isActiveProductManagement = request()->routeIs('manage.gun', 'gun.create', 'gun.edit', 'manage.accessories', 'accessory.create');
                    $isActiveGun = request()->routeIs('manage.gun', 'gun.create', 'gun.edit');
                    $isActiveAccessory = request()->routeIs('manage.accessories', 'accessory.create');
                    $isActiveCategoryBrandManagement = request()->routeIs('manage.categories', 'manageGun.categories-form', 'updateGun.form', 'manageAccessory.categories-form', 'updateAccessory.form', 'manage.brands', 'brand.create', 'brand.edit');
                    $isActiveCategory = request()->routeIs('manageGun.categories-form', 'updateGun.form', 'manage.categories', 'manageAccessory.categories-form', 'updateAccessory.form');
                    $isActiveBrand = request()->routeIs('manage.brands', 'brand.create', 'brand.edit');
                    @endphp
                    <li>
                        <a class="{{ $isActiveDashboard ? 'active-menu' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="{{ $isActiveProductManagement || request()->routeIs('gun.create') || request()->routeIs('gun.edit') ? 'active-menu-top' : '' }}"><i class="fa fa-desktop "></i>Product Management <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level {{ $isActiveProductManagement ? 'collapse in' : '' }}">
                            <li>
                                <a class="{{ $isActiveGun ? 'active-menu' : '' }}" href="{{ route('manage.gun') }}">Manage Guns</a>
                            </li>
                            <li>
                                <a class="{{ $isActiveAccessory ? 'active-menu' : '' }}" href="{{ route('manage.accessories') }}"></i>Manage Accessories</a>
                            </li>
                        </ul>
                    </li>
                     <li>
                        <a href="#" class="{{ $isActiveCategoryBrandManagement ? 'active-menu-top' : ''}}"><i class="fa fa-yelp "></i>Categories and Brands <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level {{ $isActiveCategoryBrandManagement ? 'collapse in' : '' }}">
                            <li>
                                <a class="{{ $isActiveCategory ? 'active-menu' : ''}}"  href="{{ route('manage.categories') }}">Manage Categories</a>
                            </li>
                             <li>
                                <a class="{{ $isActiveBrand ? 'active-menu' : '' }}" href="{{ route('manage.brands') }}">Manage Brands</a>
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