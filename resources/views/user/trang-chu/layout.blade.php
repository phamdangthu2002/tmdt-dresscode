<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DressCode - Thời Trang Hiện Đại</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free-6.7.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/trangchu.css') }}">
</head>

<body>
    <!-- Header -->
    @include('user.trang-chu.header')
    <!-- Hero Section -->
    @include('user.trang-chu.hero')
    <!-- Categories Section -->
    @include('user.trang-chu.cate')
    <!-- Featured Products -->
    @include('user.san-pham.index')
    <!-- Collections Banner -->
    @include('user.trang-chu.banner')
    <!-- Promotions -->
    @include('user.trang-chu.promotion')
    <!-- Customer Reviews -->
    @include('user.trang-chu.review')
    <!-- Footer -->
    <!-- Newsletter -->
    @include('user.trang-chu.footer')

    <script src="{{ asset('assets/js/trangchu.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
