<!DOCTYPE html>
<html lang="en" ng-app="myApp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Layout</title>
    <link href="{{ asset('assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/boxicons-2.1.4/css/boxicons.min.css') }}">
    <link href="{{ asset('assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <style>
        .sidebar a.active {
            background-color: #85858b;
            /* Màu nền xanh lá */
            color: white;
        }
    </style>
</head>

<body ng-controller="CtrlAdmin">
    <div class="header">
        <button class="toggle-btn" onclick="toggleSidebar()"><i class="bx bx-menu"></i></button>
        <div class="search-container">
            <i class="bx bx-search search-icon"></i>
            <input type="search" placeholder="Search..." class="search" />
        </div>
    </div>

    {{-- <div class="sidebar" id="sidebar">
        <h2>Admin Panel</h2>
        <a href="{{ route('admin.index') }}"><i class="bx bx-home"></i><span>Dashboard</span></a>
        <a href="{{ route('admin.user.index') }}"><i class="bx bx-user"></i><span>Users</span></a>
        <a href="{{ route('admin.danhmuc.index') }}"><i class="bx bxs-category"></i><span>Categories</span></a>
        <a href="{{ route('admin.sanpham.index') }}"><i class='bx bxs-t-shirt'></i><span>Products</span></a>
        <a href="{{ route('admin.size.index') }}"><i class='bx bx-font-size' ></i><span>Size</span></a>
        <a href="{{ route('admin.color.index') }}"><i class='bx bx-palette' ></i><span>Color</span></a>
        <a href="#" ng-click="logout()"><i class="bx bx-log-out"></i><span>Logout</span></a>
    </div> --}}

    <div class="sidebar" id="sidebar">
        <h2>Admin Panel</h2>
        <a href="{{ route('admin.index') }}" class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <i class="bx bx-home"></i><span>Dashboard</span>
        </a>
        <a href="{{ route('admin.user.index') }}" class="{{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
            <i class="bx bx-user"></i><span>Users</span>
        </a>
        <a href="{{ route('admin.danhmuc.index') }}"
            class="{{ request()->routeIs('admin.danhmuc.index') ? 'active' : '' }}">
            <i class="bx bxs-category"></i><span>Categories</span>
        </a>
        <a href="{{ route('admin.sanpham.index') }}"
            class="{{ request()->routeIs('admin.sanpham.index') ? 'active' : '' }}">
            <i class='bx bxs-t-shirt'></i><span>Products</span>
        </a>
        <a href="{{ route('admin.size.index') }}"
            class="{{ request()->routeIs('admin.size.index') ? 'active' : '' }}">
            <i class='bx bx-font-size'></i><span>Size</span>
        </a>
        <a href="{{ route('admin.color.index') }}"
            class="{{ request()->routeIs('admin.color.index') ? 'active' : '' }}">
            <i class='bx bx-palette'></i><span>Color</span>
        </a>
        <a href="{{ route('admin.cart.index') }}"
            class="{{ request()->routeIs('admin.cart.index') ? 'active' : '' }}">
            <i class='bx bx-cart'></i><span>Cart</span>
        </a>
        <a href="#" ng-click="logout()">
            <i class="bx bx-log-out"></i><span>Logout</span>
        </a>
    </div>


    <div class="content">
        @yield('content')
    </div>
    <script src="{{ asset('assets/vendor/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin.js') }}"></script>
    <script src="{{ asset('assets/vendor/angular.min.js') }}"></script>
    <script src="{{ asset('assets/js/adminangular.js') }}"></script>
</body>

</html>
