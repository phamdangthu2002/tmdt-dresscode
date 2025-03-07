<!DOCTYPE html>
<html lang="vi" ng-app="trangchu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DressCode - Thời Trang Hiện Đại</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free-6.7.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/trangchu.css') }}">
</head>

<body ng-controller="CtrlTrangchu">
    <input type="hidden" id="user_id" value="{{ Auth::check() ? Auth::user()->id : null }}">
    <!-- Header -->
    @include('user.trang-chu.header')
    <!-- Content -->
    @yield('content')
    <!-- Footer -->
    <!-- Newsletter -->
    @include('user.trang-chu.footer')

    <script src="{{ asset('assets/vendor/angular.min.js') }}"></script>
    <script src="{{ asset('assets/js/trangchu.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        var app = angular.module("trangchu", []);
    </script>
    <script src="{{ asset('assets/js/trangchuangular.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/sanpham.js') }}"></script> --}}
</body>

</html>
