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
            <div class="col-6 col-md-4 col-lg-3 fade-in">
                <div class="product-card">
                    <span class="product-badge">Mới</span>
                    <div class="overflow-hidden position-relative">
                        <img src="https://product.hstatic.net/200000000133/product/25ssme007t_-_25sqde001x.1_02c4b4c3ed7c4e64a7e7362526d6cfbd_master.jpg" class="w-100 product-image" alt="Áo sơ mi nam" />
                        <div class="product-actions">
                            <button class="btn btn-sm btn-light rounded-circle mx-1"
                                onclick="addToWishlist('Áo sơ mi nam')">
                                <i class="far fa-heart"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle mx-1"
                                onclick="showQuickView('Áo sơ mi nam')">
                                <i class="far fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-brand rounded-circle mx-1"
                                onclick="addToCart('Áo sơ mi nam')">
                                <i class="fas fa-shopping-bag"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-primary fw-bold">550.000₫</span>
                            <div class="review-stars small">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <h5 class="product-title">Sơ mi tay dài, Dáng sơ vin 25SSME007T</h5>
                        <p class="mb-0 text-muted small">Chất liệu cao cấp, kiểu dáng hiện đại</p>
                    </div>
                </div>
            </div>

            <!-- Overlay nền -->
            <div id="quickViewOverlay" onclick="closeQuickView()"></div>

            <!-- Quick View Popup -->
            <div id="quickViewPopup">
                <span class="close" onclick="closeQuickView()">&times;</span>
                <h2 id="quickViewModalLabel">Xem nhanh</h2>
                <img id="quickViewModalImage" src="" alt="Product Image">
                <h3 id="quickViewModalPrice"></h3>
                <p id="quickViewModalDescription"></p>

                <div class="quick-view-content">
                    <label>Chọn size:</label>
                    <select id="quickViewModalSizes"></select>

                    <label>Chọn màu:</label>
                    <select id="quickViewModalColors"></select>

                    <label>Chọn chất liệu:</label>
                    <select id="quickViewModalMaterials"></select>
                </div>

                <div class="quick-view-buttons">
                    <button class="btn-add"
                        onclick="addToCart(document.getElementById('quickViewModalLabel').innerText)">Thêm vào giỏ
                        hàng</button>
                    <button class="btn-buy"
                        onclick="buyNow(document.getElementById('quickViewModalLabel').innerText)">Mua
                        ngay</button>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3 fade-in" style="animation-delay: 0.1s;">
                <div class="product-card">
                    <span class="product-badge">-15%</span>
                    <div class="overflow-hidden position-relative">
                        <img src="https://product.hstatic.net/200000000133/product/24asme106t_-_24acve112d.3_dc24454600fe4a45b4d5a7e82c8ca083_master.jpg" class="w-100 product-image" alt="Váy liền thân" />
                        <div class="product-actions">
                            <button class="btn btn-sm btn-light rounded-circle mx-1"
                                onclick="addToWishlist('Váy liền thân')">
                                <i class="far fa-heart"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle mx-1"
                                onclick="showQuickView('Váy liền thân')">
                                <i class="far fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-brand rounded-circle mx-1"
                                onclick="addToCart('Váy liền thân')">
                                <i class="fas fa-shopping-bag"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="text-primary fw-bold">680.000₫</span>
                                <span class="text-muted text-decoration-line-through ms-2 small">800.000₫</span>
                            </div>
                            <div class="review-stars small">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <h5 class="product-title">Váy liền thân</h5>
                        <p class="mb-0 text-muted small">Phong cách thanh lịch, thích hợp đi làm</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 fade-in" style="animation-delay: 0.2s;">
                <div class="product-card">
                    <div class="overflow-hidden position-relative">
                        <img src="https://product.hstatic.net/200000000133/product/25sqjc005t_d499a7083dcc4060aec117f119fd9d8e_master.jpg" class="w-100 product-image" alt="Quần jeans nam" />
                        <div class="product-actions">
                            <button class="btn btn-sm btn-light rounded-circle mx-1"
                                onclick="addToWishlist('Quần jeans nam')">
                                <i class="far fa-heart"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle mx-1"
                                onclick="showQuickView('Quần jeans nam')">
                                <i class="far fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-brand rounded-circle mx-1"
                                onclick="addToCart('Quần jeans nam')">
                                <i class="fas fa-shopping-bag"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-primary fw-bold">750.000₫</span>
                            <div class="review-stars small">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <h5 class="product-title">Quần lửng, 25SQJC005T</h5>
                        <p class="mb-0 text-muted small">Denim cao cấp, form slim fit</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 fade-in" style="animation-delay: 0.3s;">
                <div class="product-card">
                    <span class="product-badge">Hot</span>
                    <div class="overflow-hidden position-relative">
                        <img src="https://product.hstatic.net/200000000133/product/24aale002x_-_24aqjc002x_-_24acoe004g.1_27b4ded61f0a479a983dd06b4c287577_master.jpg" class="w-100 product-image" alt="Áo khoác bomber" />
                        <div class="product-actions">
                            <button class="btn btn-sm btn-light rounded-circle mx-1"
                                onclick="addToWishlist('Áo khoác bomber')">
                                <i class="far fa-heart"></i>
                            </button>
                            <button class="btn btn-sm btn-light rounded-circle mx-1"
                                onclick="showQuickView('Áo khoác bomber')">
                                <i class="far fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-brand rounded-circle mx-1"
                                onclick="addToCart('Áo khoác bomber')">
                                <i class="fas fa-shopping-bag"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-primary fw-bold">950.000₫</span>
                            <div class="review-stars small">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <h5 class="product-title">Khoác Măng tô, 24ACOE004G</h5>
                        <p class="mb-0 text-muted small">Thiết kế cá tính, giữ ấm tốt</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <button class="btn btn-outline-brand rounded-pill px-4 py-2" onclick="loadMoreProducts()">
                Xem Thêm <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </div>
    </div>
</section>
