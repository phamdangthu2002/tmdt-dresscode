<link rel="stylesheet" href="{{ asset('assets/vendor/boxicons-2.1.4/css/boxicons.min.css') }}">
<style>
    :root {
        --primary-color: #5c6ac4;
        --secondary-color: #e9e9e9;
        --border-color: #dee2e6;
        --text-color: #212529;
        --light-text: #6c757d;
    }

    /* Cart Modal Styles */
    .cart-modal {
        position: fixed;
        top: 0;
        right: -440px;
        width: 425px;
        max-width: 100%;
        height: 100%;
        background-color: white;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        transition: right 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .cart-modal.show {
        right: 0;
    }

    .cart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .cart-icon {
        font-size: 1.5rem;
    }

    .cart-count {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: var(--primary-color);
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-header h5 {
        margin: 0;
        font-weight: 600;
    }

    .close-cart {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--light-text);
    }

    .cart-shipping {
        padding: 1rem;
        background-color: var(--secondary-color);
        color: var(--text-color);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .cart-shipping i {
        color: var(--primary-color);
    }

    .cart-body {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
    }

    .empty-cart {
        text-align: center;
        padding: 2rem;
        color: var(--light-text);
    }

    .empty-cart i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .cart-item {
        display: flex;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .cart-item-image {
        width: 20%;
        height: 110px;
        object-fit: cover;
        border-radius: 4px;
    }

    .cart-item-details {
        flex: 1;
    }

    .cart-item-title {
        font-weight: 600;
        margin-bottom: 0.25rem;
        font-size: 0.95rem;
    }

    .cart-item-variant {
        color: var(--light-text);
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
    }

    .cart-item-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        /* border: 1px solid var(--border-color); */
        border-radius: 4px;
    }

    .quantity {
        background: none;
        border: none;
        width: 32px;
        height: 32px;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .quantity:hover {
        background-color: var(--secondary-color);
    }

    .quantity-input {
        width: 40px;
        border: none;
        text-align: center;
        font-size: 0.9rem;
    }

    .cart-item-price {
        font-weight: 600;
        color: green;
    }

    .cart-footer {
        padding: 1rem;
        border-top: 1px solid var(--border-color);
        background-color: white;
    }

    .cart-subtotal {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        font-weight: 600;
    }

    .cart-actions {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .checkout-btn {
        background-color: #6674d3;
        color: white;
        border: none;
        padding: 0.8rem;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .checkout-btn:hover {
        background-color: var(--primary-color);
    }

    .continue-shopping {
        text-align: center;
        color: var(--text-color);
        text-decoration: none;
        font-size: 0.9rem;
        display: block;
        margin-top: 0.5rem;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: none;
    }

    /* Voucher section */
    .voucher-section {
        padding: 1rem 0;
        border-top: 1px solid var(--border-color);
    }

    .voucher-form {
        display: flex;
        gap: 0.5rem;
    }

    .voucher-input {
        flex: 1;
        padding: 0.5rem;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .apply-voucher {
        background-color: var(--text-color);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .applied-voucher {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #e9f7ef;
        padding: 0.5rem;
        border-radius: 4px;
        margin-top: 0.5rem;
        font-size: 0.9rem;
    }

    .voucher-code {
        font-weight: 600;
        color: var(--primary-color);
    }

    .remove-voucher {
        background: none;
        border: none;
        color: var(--light-text);
        cursor: pointer;
        font-size: 0.9rem;
    }

    /* Product recommendation section */
    .recommendations {
        padding: 1rem;
        border-top: 1px solid var(--border-color);
    }

    .recommendations h6 {
        margin-bottom: 1rem;
    }

    .recommend-items {
        display: flex;
        gap: 0.5rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }

    .recommend-item {
        min-width: 105px;
        text-align: center;
        cursor: pointer;
    }

    .recommend-item img {
        width: 70%;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        margin-bottom: 0.5rem;
    }

    .recommend-item-title {
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .recommend-item-price {
        font-size: 0.8rem;
        color: var(--primary-color);
        font-weight: 600;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/home">
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
                        {{-- <li>
                            <a class="dropdown-item" href="#" onclick="showUnderConstruction()">
                                Bộ sưu tập Hè
                            </a>
                        </li> --}}
                        <li ng-repeat="danhmuc in danhmucs">
                            <a class="dropdown-item" ng-value="danhmuc.id" href="#"
                                onclick="showUnderConstruction()">
                                @{{ danhmuc.ten_danh_muc }}
                            </a>
                        </li>
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
                @if (Auth::check())
                    <a href="#" class="cart-icon me-3" onclick="showCart()">
                        {{-- <i class="fas fa-shopping-bag"></i> --}}
                        <i class='bx bx-cart-download'></i>
                        <span id="cartCount" class="cart-count">@{{ countCart }}</span>
                    </a>
                @endif


                <div id="cartModal" class="cart-modal">
                    <div class="cart-header">
                        <h5>Giỏ hàng</h5>
                        <button class="close-cart" onclick="hideCart()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    {{-- <div class="cart-shipping">
                        <i class="fas fa-truck"></i>
                        <span>Bạn đã được MIỄN PHÍ VẬN CHUYỂN</span>
                    </div> --}}
                    <div id="cartBody" class="cart-body">
                        <!-- Cart items will be loaded here by JS -->
                        <div class="cart-item" ng-repeat="giohang in giohangs">
                            <img ng-src="@{{ giohang.sanpham.anhsp }}" alt="@{{ giohang.sanpham.tensp }}" class="cart-item-image">
                            <div class="cart-item-details">
                                <div class="cart-item-title">@{{ giohang.sanpham.tensp }}</div>
                                <div class="cart-item-variant">@{{ giohang.color.name }} / @{{ giohang.size.name }}</div>
                                <div class="cart-item-actions">
                                    <div class="quantity-control">
                                        <button class="quantity" ng-click="tru()">-</button>
                                        <input type="number" class="quantity-input" ng-value="giohang.so_luong"
                                            readonly>
                                        <button class="quantity" ng-click="cong()">+</button>
                                    </div>
                                    <button class="btn btn-danger">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="cart-item-price">@{{ giohang.gia | number }} VND</div>
                        </div>
                    </div>
                    <div id="recommendationsSection" class="recommendations">
                        <h6>Có thể bạn sẽ thích</h6>
                        <div class="recommend-items">
                            <div class="recommend-item" ng-repeat="random in sanphamRandoms">
                                <img ng-src="@{{ random.anhsp }}" alt="@{{ random.tensp }}">
                                <div class="recommend-item-title">@{{ random.tensp }}</div>
                                <div class="recommend-item-price">@{{ random.gia_goc }}</div>
                            </div>
                            {{-- <div class="recommend-item">
                                <img src="https://placehold.co/400" alt="Giày cao gót">
                                <div class="recommend-item-title">Giày cao gót</div>
                                <div class="recommend-item-price">950,000₫</div>
                            </div>
                            <div class="recommend-item">
                                <img src="https://placehold.co/400" alt="Vòng tay bạc">
                                <div class="recommend-item-title">Vòng tay bạc</div>
                                <div class="recommend-item-price">450,000₫</div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="cart-footer">
                        <div id="voucherSection" class="voucher-section">
                            <div class="voucher-form">
                                <input type="text" class="voucher-input" id="voucherInput"
                                    placeholder="Nhập mã giảm giá">
                                <button class="apply-voucher" onclick="applyVoucher()">Áp dụng</button>
                            </div>
                            <div id="appliedVoucher" class="applied-voucher" style="display: none;">
                                <div>
                                    <span>Mã giảm giá: </span>
                                    <span id="voucherCode" class="voucher-code">SALE10</span>
                                </div>
                                <button class="remove-voucher" onclick="removeVoucher()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="cart-subtotal">
                            <span>Tổng tiền:</span>
                            <span id="cartTotal">@{{ total | number }} VND</span>
                        </div>
                        <div class="cart-actions">
                            <button class="checkout-btn" onclick="checkout()">THANH
                                TOÁN</button>
                            <a href="#" class="continue-shopping" onclick="hideCart(); return false;">Xem giỏ
                                hàng</a>
                        </div>
                    </div>
                </div>

                <!-- Notification -->
                <div id="notification" class="notification"></div>

                <div id="overlay" class="overlay" onclick="hideCart()"></div>

                @if (Auth::check())
                    <a href="#" class="me-3" onclick="showWishlist()">
                        <i class="far fa-heart"></i>
                    </a>
                @endif

                <!-- Nút đăng nhập -->
                @if (Auth::check())
                    <label for="name" class="nav-link mx-2" style="cursor: pointer;"><a href="#"
                            style="text-decoration: none;color: black">Hi
                            {{ Auth::user()->name }}!</a></label>
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
<script>
    // Show cart
    function showCart() {
        document.getElementById('cartModal').classList.add('show');
        document.getElementById('overlay').style.display = 'block';
    }

    // Hide cart
    function hideCart() {
        document.getElementById('cartModal').classList.remove('show');
        document.getElementById('overlay').style.display = 'none';
    }
    // Show notification
    function showNotification(message) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'fade-in';
        notification.style.position = 'fixed';
        notification.style.bottom = '20px';
        notification.style.right = '20px';
        notification.style.backgroundColor = 'var(--primary-color)';
        notification.style.color = 'white';
        notification.style.padding = '10px 20px';
        notification.style.borderRadius = '4px';
        notification.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        notification.style.zIndex = '2000';
        notification.textContent = message;

        // Add to body
        document.body.appendChild(notification);

        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.5s';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 500);
        }, 3000);
    }
</script>
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
