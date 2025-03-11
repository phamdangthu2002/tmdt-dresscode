@extends('user.trang-chu.layout')
@section('content')
    <style>
        .breadcrumb {
            background-color: transparent;
            padding: 8px 0;
        }

        .breadcrumb-item a {
            text-decoration: none;
            color: #007bff;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        /* .product-subinfo {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                background: #f8f8f8;
                padding: 20px;
                border-radius: 10px;
            }

            .subinfo-block {
                flex: 1;
                min-width: 300px;
                background: #fff;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .subtitle {
                font-size: 18px;
                font-weight: bold;
                color: #333;
                margin-bottom: 15px;
                text-transform: uppercase;
                border-bottom: 2px solid #27ae60;
                padding-bottom: 5px;
            }

            .subinfo-list {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .item {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px;
                border-radius: 6px;
                transition: all 0.3s ease;
            }

            .item:hover {
                background: rgba(39, 174, 96, 0.1);
                transform: translateY(-2px);
            }

            .item--img img {
                width: 40px;
                height: 40px;
                object-fit: contain;
            }

            .item--text {
                font-size: 14px;
                color: #555;
            }

            .item--text strong {
                color: #e74c3c;
                font-weight: bold;
            } */




        .product-subinfo {
            display: flex;
            flex-direction: column;
            gap: 16px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .subinfo-block {
            padding: 15px;
            border-radius: 6px;
            background: #f8f8f8;
        }

        .subtitle {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .subinfo-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .item--img img {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .item--text {
            font-size: 14px;
            color: #444;
            font-weight: 500;
        }

        .item--text strong {
            color: #d63031;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/sanpham.css') }}">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/home">Trang chủ</a>
            </li>
            <li class="breadcrumb-item" ng-if="danhmucs">
                <a href="#/category/@{{ category.id }}">@{{ danhmucs[0].ten_danh_muc }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" ng-if="product">
                @{{ product.tensp }}
            </li>
        </ol>
    </nav>

    <div class="container">
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
                    <label class="color-label">Màu sắc: <span class="text-danger">@{{ detail.color.name }}</span></label>
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
                <button class="btn-add-cart btn btn-outline-dark mt-4" ng-click="addToCart(detail)">THÊM VÀO GIỎ</button>
                <button class="btn-add-cart btn btn-dark mt-4" ng-click="buy()">MUA NGAY</button>
                <div class="info-footer mt-5">
                    <div class="product-subinfo">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="subinfo-block">
                                    <div class="subtitle">
                                        <span>Chính sách bán hàng</span>
                                    </div>
                                    <div class="subinfo-list">
                                        <div class="item">
                                            <div class="item--img">
                                                <img class=" ls-is-cached lazyloaded"
                                                    data-src="//theme.hstatic.net/200000000133/1001205759/14/product_info1_desc1_img.png?v=1641"
                                                    src="//theme.hstatic.net/200000000133/1001205759/14/product_info1_desc1_img.png?v=1641"
                                                    alt="MIỄN PHÍ giao hàng từ 699,000đ">
                                            </div>
                                            <div class="item--text">MIỄN PHÍ giao hàng từ 699,000đ</div>
                                        </div>
                                        <div class="item">
                                            <div class="item--img">
                                                <img class=" ls-is-cached lazyloaded"
                                                    data-src="//theme.hstatic.net/200000000133/1001205759/14/product_info1_desc2_img.png?v=1641"
                                                    src="//theme.hstatic.net/200000000133/1001205759/14/product_info1_desc2_img.png?v=1641"
                                                    alt="MIỄN PHÍ cước đổi hàng">
                                            </div>
                                            <div class="item--text">MIỄN PHÍ cước đổi hàng</div>
                                        </div>
                                        <div class="item">
                                            <div class="item--img">
                                                <img class=" lazyloaded"
                                                    data-src="//theme.hstatic.net/200000000133/1001205759/14/product_info1_desc3_img.png?v=1641"
                                                    src="//theme.hstatic.net/200000000133/1001205759/14/product_info1_desc3_img.png?v=1641"
                                                    alt="Giao mới thu cũ trên 1 lần giao">
                                            </div>
                                            <div class="item--text">Giao mới thu cũ trên 1 lần giao</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="subinfo-block">
                                    <div class="subtitle">
                                        <span>Thông tin thêm</span>
                                    </div>
                                    <div class="subinfo-list">
                                        <div class="item">
                                            <div class="item--img">
                                                <img class=" lazyloaded"
                                                    data-src="//theme.hstatic.net/200000000133/1001205759/14/product_info2_desc1_img.png?v=1641"
                                                    src="//theme.hstatic.net/200000000133/1001205759/14/product_info2_desc1_img.png?v=1641"
                                                    alt="Hotline MIỄN PHÍ 1800 1732">
                                            </div>
                                            <div class="item--text">Hotline MIỄN PHÍ <strong>1900******</strong></div>
                                        </div>
                                        <div class="item">
                                            <div class="item--img">
                                                <img class=" lazyloaded"
                                                    data-src="//theme.hstatic.net/200000000133/1001205759/14/product_info2_desc2_img.png?v=1641"
                                                    src="//theme.hstatic.net/200000000133/1001205759/14/product_info2_desc2_img.png?v=1641"
                                                    alt="Mở hộp kiểm tra nhận hàng">
                                            </div>
                                            <div class="item--text">Mở hộp kiểm tra nhận hàng</div>
                                        </div>
                                        <div class="item">
                                            <div class="item--img">
                                                <img class=" lazyloaded"
                                                    data-src="//theme.hstatic.net/200000000133/1001205759/14/product_info2_desc3_img.png?v=1641"
                                                    src="//theme.hstatic.net/200000000133/1001205759/14/product_info2_desc3_img.png?v=1641"
                                                    alt="Đa dạng hình thức thanh toán">
                                            </div>
                                            <div class="item--text">Đa dạng hình thức thanh toán</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social-icons mt-3">
                    <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="messenger"><i class="fab fa-facebook-messenger"></i></a>
                    <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="pinterest"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#" class="link"><i class="fas fa-link"></i></a>
                </div>
            </div>
        </div>

        <section class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <h2 class="fw-bold mb-4">Sản phẩm liên quan</h2>
                        <div class="section-divider"></div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-6 col-md-4 col-lg-3 fade-in" ng-repeat="sanpham in sanphams">
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
                                    <button class="btn btn-sm btn-light rounded-circle mx-1"
                                        ng-click="showQuickView(sanpham)">
                                        <i class="far fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-light rounded-circle mx-1"
                                        ng-click="addTocart(sanpham)">
                                        <i class="fas fa-shopping-bag"></i>
                                    </button>
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
                                <a ng-click="sanPham(sanpham)">
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
                            <button class="btn-add-cart mt-4" ng-click="addToCart(detail)">THÊM VÀO GIỎ</button>
                            <div class="social-icons mt-3">
                                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="messenger"><i class="fab fa-facebook-messenger"></i></a>
                                <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="pinterest"><i class="fab fa-pinterest-p"></i></a>
                                <a href="#" class="link"><i class="fas fa-link"></i></a>
                            </div>
                            <a href="#" class="view-details mt-3">Xem chi tiết sản phẩm »</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
