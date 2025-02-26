<link rel="stylesheet" href="{{ asset('assets/vendor/boxicons-2.1.4/css/boxicons.min.css') }}">
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
                @if (Auth::check())
                    <label for="name" class="nav-link mx-2">Hi {{ Auth::user()->name }}!</label>
                    <a href="#" ng-click="logout()" class="btn btn-outline-brand rounded-pill px-3">
                        <i class="fas fa-user me-2"></i>Đăng xuất
                    </a>
                @else
                    <a href="#" class="btn btn-outline-brand rounded-pill px-3" id="btn-login">
                        <i class="fas fa-user me-2"></i>Đăng nhập
                    </a>
                @endif
                <!-- Popup -->
                @include('auth.login')
            </div>
        </div>
    </div>
</nav>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://www.google.com/recaptcha/api.js?render=explicit" async defer></script>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: '1357079708765657', // Thay YOUR_FACEBOOK_APP_ID bằng ID ứng dụng của bạn
            cookie: true,
            xfbml: true,
            version: 'v17.0'
        });
    };

    function loginWithFacebook() {
        FB.login(function(response) {
            if (response.authResponse) {
                FB.api('/me', {
                    fields: 'id,name,email'
                }, function(userInfo) {
                    console.log(userInfo);
                    alert('Đăng nhập thành công: ' + userInfo.name);
                });
            } else {
                alert('Bạn đã từ chối đăng nhập bằng Facebook.');
            }
        }, {
            scope: 'email,public_profile'
        });
    }

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
