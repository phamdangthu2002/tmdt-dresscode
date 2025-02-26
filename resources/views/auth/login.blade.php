<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>

        <!-- Form Đăng nhập -->
        <div id="login-form">
            <h2>Đăng nhập</h2>
            <input type="text" class="form-control mb-2" id="login-email" ng-model="email" placeholder="Email">
            <div ng-if="errors.email" class="form-text text-danger">
                @{{ errors.email[0] }}
            </div>
            <input type="password" class="form-control mb-2" id="login-password" ng-model="password"
                placeholder="Mật khẩu">
            <div ng-if="errors.password" class="form-text text-danger">
                @{{ errors.password[0] }}
            </div>

            <!-- Google reCAPTCHA -->
            {{-- <div class="mb-3 mt-3">
                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" ng-model="gRecaptchaResponse">
                </div>
                <input type="hidden" ng-model="gRecaptchaResponse" name="g-recaptcha-response">
                <div ng-if="errors.g-recaptcha-response" class="form-text text-danger">
                    @{{ errors.g - recaptcha - response[0] }}
                </div>
            </div> --}}
            <button type="button" class="btn btn-primary facebook mt-3" onclick="loginWithFacebook()">
                <i class='bx bxl-facebook-circle'></i> Đăng nhập bằng Facebook
            </button>
            <p class="text-center">Bạn chưa có tài khoản?
                <a href="#" id="toggle-register">Đăng ký ngay</a>
            </p>
            <button class="btn btn-primary" ng-click="login()">Đăng nhập</button>
        </div>

        <!-- Form Đăng ký (ẩn ban đầu) -->
        <div id="register-form" style="display: none;">
            <h2>Đăng ký</h2>
            <input type="text" class="form-control mb-2" id="register-name" placeholder="Họ và tên" ng-model="name">
            <div ng-if="errors.name" class="form-text text-danger">
                @{{ errors.name[0] }}
            </div>
            <input type="text" class="form-control mb-2" id="register-email" placeholder="Email" ng-model="email">
            <div ng-if="errors.email" class="form-text text-danger">
                @{{ errors.email[0] }}
            </div>
            <input type="password" class="form-control mb-2" id="register-password" placeholder="Mật khẩu"
                ng-model="password">
            <div ng-if="errors.password" class="form-text text-danger">
                @{{ errors.password[0] }}
            </div>
            {{-- <input type="password" class="form-control mb-2" id="register-confirm-password"
                placeholder="Xác nhận mật khẩu"> --}}
            {{-- <div class="mb-3 mt-3">
                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
            </div> --}}
            <p class="text-center">Bạn đã có tài khoản? <a href="#" id="toggle-login">Đăng
                    nhập</a></p>
            <button class="btn btn-success" ng-click="register()">Đăng ký</button>
        </div>
    </div>
</div>
