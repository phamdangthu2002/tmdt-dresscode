<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <span class="fw-bold fs-4 text-primary">Dress<span class="text-dark">Code</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link mx-2" href="#" onclick="showUnderConstruction()">Nam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="#" onclick="showUnderConstruction()">Nữ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="#" onclick="showUnderConstruction()">Trẻ em</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mx-2" href="#" id="collectionDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Bộ sưu tập
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="collectionDropdown">
                        <li><a class="dropdown-item" href="#" onclick="showUnderConstruction()">Bộ sưu tập
                                Hè</a></li>
                        <li><a class="dropdown-item" href="#" onclick="showUnderConstruction()">Bộ sưu tập
                                Thu</a></li>
                        <li><a class="dropdown-item" href="#" onclick="showUnderConstruction()">Bộ sưu tập
                                Đông</a></li>
                        <li><a class="dropdown-item" href="#" onclick="showUnderConstruction()">Bộ sưu tập
                                Xuân</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="#" onclick="showUnderConstruction()">Giảm giá</a>
                </li>
            </ul>
            <div class="d-flex align-items-center ms-lg-4">
                <a href="#" class="me-3" onclick="showSearch()">
                    <i class="fas fa-search"></i>
                </a>
                <!-- Nút giỏ hàng -->
                <a href="#" class="cart-icon me-3" onclick="showCart()">
                    <i class="fas fa-shopping-bag"></i>
                    <span id="cartCount" class="cart-count">0</span>
                </a>

                <!-- Overlay nền tối -->
                <div id="cartOverlay" onclick="closeCart()"></div>

                <!-- Popup Giỏ Hàng -->
                <div id="cartPopup">
                    <span class="close-btn" onclick="closeCart()">&times;</span>
                    <h2>Giỏ hàng</h2>
                    <ul id="cartItems" class="cart-items"></ul>
                    <button class="checkout-btn" onclick="checkout()">Thanh toán</button>
                </div>

                <a href="#" class="me-3" onclick="showWishlist()">
                    <i class="far fa-heart"></i>
                </a>

                <!-- Nút đăng nhập -->
                <a href="#" class="btn btn-outline-brand rounded-pill px-3" id="btn-login">
                    <i class="fas fa-user me-2"></i>Đăng nhập
                </a>

                <!-- Popup -->
                <div id="popup" class="popup">
                    <div class="popup-content">
                        <span class="close">&times;</span>

                        <!-- Form Đăng nhập -->
                        <div id="login-form">
                            <h2>Đăng nhập</h2>
                            <input type="text" class="form-control mb-2" id="login-email" placeholder="Email">
                            <input type="password" class="form-control mb-2" id="login-password" placeholder="Mật khẩu">
                            <p class="text-center">Bạn chưa có tài khoản? <a href="#" id="toggle-register">Đăng ký
                                    ngay</a></p>
                            <button class="btn btn-primary">Đăng nhập</button>
                        </div>

                        <!-- Form Đăng ký (ẩn ban đầu) -->
                        <div id="register-form" style="display: none;">
                            <h2>Đăng ký</h2>
                            <input type="text" class="form-control mb-2" id="register-name"
                                placeholder="Họ và tên">
                            <input type="text" class="form-control mb-2" id="register-email" placeholder="Email">
                            <input type="password" class="form-control mb-2" id="register-password"
                                placeholder="Mật khẩu">
                            <input type="password" class="form-control mb-2" id="register-confirm-password"
                                placeholder="Xác nhận mật khẩu">
                            <p class="text-center">Bạn đã có tài khoản? <a href="#" id="toggle-login">Đăng
                                    nhập</a></p>
                            <button class="btn btn-success">Đăng ký</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
