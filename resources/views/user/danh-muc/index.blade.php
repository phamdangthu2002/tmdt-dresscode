@extends('user.trang-chu.layout')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/sanpham.css') }}">
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h6 class="text-primary fw-bold"> Danh mục: {{ $danhmuc->ten_danh_muc }}</h6>
                    <input type="hidden" id="danhmuc_id" value="{{ $danhmuc->id }}">
                    {{-- <h2 class="fw-bold mb-4">Sản Phẩm Nổi Bật</h2> --}}
                    <div class="section-divider"></div>
                </div>
            </div>
            <div class="row g-4">
                <div ng-if="danhmuc_ids.length === 0" class="empty-cart">
                    <p>
                        Không có sản phẩm nào trong danh mục này.
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-3 fade-in" ng-repeat="sanpham in danhmuc_ids">
                    <div class="product-card">
                        <span class="product-badge">Mới</span>
                        <div class="overflow-hidden position-relative">
                            <img ng-src="@{{ sanpham.anhsp }}" class="w-100 product-image" alt="Áo sơ mi nam" />
                            <div class="product-actions">
                                <button class="btn btn-sm btn-light rounded-circle mx-1"
                                    onclick="addToWishlist('Áo sơ mi nam')">
                                    <i class="far fa-heart"></i>
                                </button>
                                <!-- Nút Xem Nhanh -->
                                <button class="btn btn-sm btn-light rounded-circle mx-1" ng-click="showQuickView(sanpham)">
                                    <i class="far fa-eye"></i>
                                </button>
                                {{-- <button class="btn btn-sm btn-light rounded-circle mx-1" ng-click="addTocart(sanpham)">
                                <i class="fas fa-shopping-bag"></i>
                            </button> --}}
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-primary fw-bold">@{{ sanpham.gia_goc | number }} VND</span>
                                <div class="review-stars small">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <a ng-click="sanPham(sanpham)" style="cursor: pointer;">
                                <h5 class="product-title">@{{ sanpham.tensp }}</h5>
                            </a>
                            <p class="mb-0 text-muted small">@{{ sanpham.mo_ta }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="quick-view-overlay" id="quickViewOverlay">
            <div class="quick-view-content">
                <button class="quick-view-close" ng-click="closeQuickView()">
                    <i class="fas fa-times"></i>
                </button>
                <div class="row">
                    <div class="col-md-6">
                        <img id="mainImage" ng-src="@{{ detail.anhsp }}" class="img-fluid" alt="Sản phẩm">
                        <div class="product-thumbnails">
                            <div class="thumb-item" ng-class="{active: detail.anhsp === anh.url_anh}"
                                ng-repeat="anh in detail.anhs track by $index" ng-click="changeImage(anh.url_anh)">
                                <img ng-src="@{{ anh.url_anh }}" alt="Thumbnail @{{ $index + 1 }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h2 class="product-title">@{{ detail.tensp }}</h2>
                        <p>
                            <strong>Mã sản phẩm:</strong> @{{ detail.id }} |
                            <strong>Tình trạng:</strong> <span class="text-success">Còn hàng</span>
                        </p>
                        <p><strong>Thương hiệu:</strong> <span class="fw-bold">Eva De Eva</span></p>
                        <p class="product-price">@{{ detail.gia_goc | number }} VND</p>
                        <div>
                            <label class="color-label">Màu sắc: <span
                                    class="text-danger">@{{ detail.color.name }}</span></label>
                            <div class="color-selector">
                                <div class="color-option active">@{{ detail.color.name }}</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="size-selector">
                                <button class="size-btn" ng-repeat="size in loadSize" ng-click="selectSize(size)"
                                    ng-class="{'active': selectedSize === size.id}">
                                    @{{ size.name }}
                                </button>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label><strong>Số lượng:</strong></label>
                            <div class="quantity-selector">
                                <button class="quantity-btn decrease" ng-click="decreaseQuantity()">-</button>
                                <input type="text" class="quantity-input" ng-model="cart.so_luong" readonly>
                                <button class="quantity-btn increase" ng-click="increaseQuantity()">+</button>
                            </div>
                        </div>
                        <button class="btn-add-cart btn btn-outline-dark mt-4" ng-click="addToCart(detail)">THÊM VÀO
                            GIỎ</button>
                        <div class="social-icons mt-3">
                            <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="messenger"><i class="fab fa-facebook-messenger"></i></a>
                            <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="pinterest"><i class="fab fa-pinterest-p"></i></a>
                            <a href="#" class="link"><i class="fas fa-link"></i></a>
                        </div>
                        <a ng-click="sanPham(detail)" class="view-details mt-3">Xem chi tiết sản phẩm »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
