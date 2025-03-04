<style>
    .quick-view-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .quick-view-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .quick-view-content {
        background-color: #fff;
        border-radius: 0;
        padding: 30px;
        position: relative;
        width: 90%;
        max-width: 900px;
        max-height: 90vh;
        overflow-y: auto;
    }

    .quick-view-close {
        position: absolute;
        top: 15px;
        right: 15px;
        background: transparent;
        border: none;
        font-size: 18px;
        cursor: pointer;
        z-index: 10;
        color: #999;
    }

    /* Thumbnails sản phẩm */
    .product-thumbnails {
        display: flex;
        margin-top: 10px;
        overflow-x: auto;
    }

    .thumb-item {
        width: 60px;
        height: 60px;
        border: 1px solid #e0e0e0;
        margin-right: 5px;
        cursor: pointer;
        padding: 2px;
    }

    .thumb-item.active {
        border-color: #000;
    }

    .thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Thông tin sản phẩm */
    .product-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 24px;
        color: #ff0000;
        font-weight: 700;
        margin: 15px 0;
    }

    /* Màu sắc sản phẩm */
    .color-label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .color-option {
        position: relative;
        min-width: 90px;
        height: 40px;
        border: 1px solid #ddd;
        background-color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 5px;
        cursor: pointer;
        font-size: 14px;
        border-radius: 5px;
    }

    .color-option.active {
        border-color: #000;
    }

    .color-option.active:after {
        content: "";
        position: absolute;
        top: -7px;
        right: -11px;
        width: 12px;
        height: 12px;
        /* Icon tick màu trắng (fill='%23FFF') dạng data URI */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24'%3E%3Cpath fill='%23FFF' d='M9 16.17L4.83 12l-1.42 1.41L9 19l11.71-11.71-1.41-1.41L9 16.17z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: contain;
        /* Dịch chuyển icon vào giữa góc đen (tuỳ chỉnh theo ý bạn) */
        transform: translate(-9px, 5px);
        z-index: 2;
        /* Icon tick nằm trên tam giác */
    }

    .color-option.active::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 0;
        height: 0;
        border-top: 15px solid #000;
        /* Chiều cao tam giác đen */
        border-left: 15px solid transparent;
        /* Phần tam giác trong suốt */
        z-index: 1;
        /* Tam giác nằm dưới icon tick */
    }

    /* Kích thước sản phẩm */
    .size-btn {
        position: relative;
        min-width: 58px;
        height: 40px;
        border: 1px solid #ddd;
        background-color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 5px;
        cursor: pointer;
        font-size: 14px;
        border-radius: 5px;
        margin-right: 10px
    }

    /* Khi nút được chọn */
    .size-btn.active {
        border-color: #000;
        color: #000;
    }

    /* Tạo tam giác đen ở góc trên bên phải */
    .size-btn.active::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 0;
        height: 0;
        border-top: 15px solid #000;
        /* Chiều cao tam giác đen */
        border-left: 15px solid transparent;
        /* Phần tam giác trong suốt */
        z-index: 1;
        /* Tam giác nằm dưới icon tick */
    }

    /* Đặt icon tick (màu trắng) đè lên tam giác đen */
    .size-btn.active::after {
        content: "";
        position: absolute;
        top: -7px;
        right: -11px;
        width: 12px;
        height: 12px;
        /* Icon tick màu trắng (fill='%23FFF') dạng data URI */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24'%3E%3Cpath fill='%23FFF' d='M9 16.17L4.83 12l-1.42 1.41L9 19l11.71-11.71-1.41-1.41L9 16.17z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: contain;
        /* Dịch chuyển icon vào giữa góc đen (tuỳ chỉnh theo ý bạn) */
        transform: translate(-9px, 5px);
        z-index: 2;
        /* Icon tick nằm trên tam giác */
    }

    /* Nút ở trạng thái disabled */
    .size-btn.disabled {
        color: #ccc;
        cursor: not-allowed;
        background-color: #f5f5f5;
    }



    /* Số lượng sản phẩm */
    .quantity-selector {
        display: flex;
        align-items: center;
        max-width: 120px;
        border: 1px solid #ddd;
        border-radius: 6px;
        overflow: hidden;
        /* Đảm bảo bo góc khi chứa input */
    }

    .quantity-btn {
        width: 355px;
        height: 35px;
        background-color: #f9f9f9;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.2s ease-in-out;
    }

    .quantity-btn:hover {
        background-color: #e0e0e0;
    }

    .quantity-input {
        width: 47px;
        height: 35px;
        border: none;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        outline: none;
        background-color: white;
    }

    /* Khi input được focus */
    .quantity-input:focus {
        box-shadow: inset 0 0 2px #007bff;
    }

    /* Nếu muốn button trái/phải có viền tách biệt */
    .quantity-btn:first-child {
        border-right: 1px solid #ddd;
    }

    .quantity-btn:last-child {
        border-left: 1px solid #ddd;
    }


    /* Nút thêm vào giỏ */
    .btn-add-cart {
        display: block;
        width: 100%;
        padding: 12px;
        background-color: #000;
        color: #fff;
        text-align: center;
        border: none;
        cursor: pointer;
        font-weight: 600;
        text-transform: uppercase;
    }

    .btn-add-cart:hover {
        background-color: #333;
    }

    /* Icons mạng xã hội */
    .social-icons {
        margin-top: 15px;
    }

    .social-icons a {
        display: inline-block;
        margin-right: 10px;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        text-align: center;
        line-height: 35px;
    }

    .social-icons .facebook {
        background-color: #3b5998;
        color: white;
    }

    .social-icons .messenger {
        background-color: #0084ff;
        color: white;
    }

    .social-icons .twitter {
        background-color: #1da1f2;
        color: white;
    }

    .social-icons .pinterest {
        background-color: #bd081c;
        color: white;
    }

    .social-icons .link {
        background-color: #ccc;
        color: white;
    }

    /* Link xem chi tiết */
    .view-details {
        display: inline-block;
        margin-top: 15px;
        color: #000;
        text-decoration: none;
    }

    /* Nút xem nhanh */
    .btn-sm.btn-light {
        width: 30px;
        height: 30px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-sm.btn-light.banner {
        width: 170px;
        height: 30px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-light:hover {
        background-color: #5c6ac4;
        color: white;
        border-color: #5c6ac4;
    }
</style>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h6 class="text-primary fw-bold">BÁN CHẠY</h6>
                <h2 class="fw-bold mb-4">Sản Phẩm Nổi Bật</h2>
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
                            <button class="btn btn-sm btn-light rounded-circle mx-1" ng-click="showQuickView(sanpham)">
                                <i class="far fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle mx-1"
                                onclick="addToCart('Áo sơ mi nam')">
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
                        <h5 class="product-title">@{{ sanpham.tensp }}</h5>
                        <p class="mb-0 text-muted small">@{{ sanpham.mo_ta }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-5">
        <button class="btn btn-outline-brand rounded-pill px-4 py-2" onclick="loadMoreProducts()">
            Xem Thêm <i class="fas fa-arrow-right ms-2"></i>
        </button>
    </div>
    <div class="quick-view-overlay" id="quickViewOverlay">
        <div class="quick-view-content">
            <button class="quick-view-close">
                <i class="fas fa-times"></i>
            </button>
            <div class="row">
                <div class="col-md-6">
                    <img id="mainImage" ng-src="@{{ deltail.anhsp }}" class="img-fluid" alt="Sản phẩm">
                    <div class="product-thumbnails">
                        <div class="thumb-item" ng-class="{active: deltail.anhsp === anh.url_anh}"
                            ng-repeat="anh in deltail.anhs track by $index" ng-click="changeImage(anh.url_anh)">
                            <img ng-src="@{{ anh.url_anh }}" alt="Thumbnail @{{ $index + 1 }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h2 class="product-title">@{{ deltail.tensp }}</h2>
                    <p>
                        <strong>Mã sản phẩm:</strong> @{{ detail.id }} |
                        <strong>Tình trạng:</strong> <span class="text-success">Còn hàng</span>
                    </p>
                    <p><strong>Thương hiệu:</strong> <span class="fw-bold">Eva De Eva</span></p>
                    <p class="product-price">@{{ deltail.gia_goc | number }} VND</p>
                    <div>
                        <label class="color-label">Màu sắc: <span
                                class="text-danger">@{{ deltail.color.name }}</span></label>
                        <div class="color-selector">
                            <div class="color-option active">@{{ deltail.color.name }}</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="size-selector">
                            <button class="size-btn" ng-repeat="size in loadSize" ng-click="selectSize(size)"
                                ng-class="{'active': selectedSize.id === size.id}">
                                @{{ size.name }}
                            </button>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label><strong>Số lượng:</strong></label>
                        <div class="quantity-selector">
                            <button class="quantity-btn decrease" ng-click="decreaseQuantity()">-</button>
                            <input type="text" class="quantity-input" ng-model="quantity" readonly>
                            <button class="quantity-btn increase" ng-click="increaseQuantity()">+</button>
                        </div>
                    </div>
                    <button class="btn-add-cart mt-4">THÊM VÀO GIỎ</button>
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
<script>
    // Tăng giảm số lượng
    document.querySelector('.quantity-btn.decrease').addEventListener('click', function() {
        const input = document.querySelector('.quantity-input');
        let value = parseInt(input.value);
        if (value > 1) {
            input.value = value - 1;
        }
    });

    document.querySelector('.quantity-btn.increase').addEventListener('click', function() {
        const input = document.querySelector('.quantity-input');
        let value = parseInt(input.value);
        input.value = value + 1;
    });
</script>
