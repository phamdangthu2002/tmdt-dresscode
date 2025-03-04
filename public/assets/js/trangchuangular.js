var app = angular.module("trangchu", []);
app.controller("CtrlTrangchu", function ($scope, $http) {
    var config = {
        headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer YOUR_ACCESS_TOKEN", // Nếu API yêu cầu token
        },
    };
    $scope.errors = {};
    $scope.sanphams = [];
    $scope.deltail = [];
    $scope.loadSize = [];
    $scope.mauSac = {};
    $scope.danhmucs = [];

    $scope.urlloadSize = "/api/load/size";
    $scope.urlloadDanhmucHome = "/api/load/danh-muc-home";

    $scope.selectedSize = {}; // Khởi tạo giá trị size rỗng
    $scope.quantity = 1; // Giá trị mặc định

    $scope.changeImage = function (url) {
        $scope.deltail.anhsp = url;
    };

    $scope.selectSize = function (size) {
        $scope.selectedSize = size; // Gán giá trị size được chọn
        console.log("Size đã chọn:", size);
    };

    $scope.increaseQuantity = function () {
        $scope.quantity++; // Tăng số lượng
    };

    $scope.decreaseQuantity = function () {
        if ($scope.quantity > 1) {
            $scope.quantity--; // Giảm số lượng nhưng không nhỏ hơn 1
        }
    };

    $scope.login = async function () {
        // let recaptchaResponse = grecaptcha.getResponse();
        // console.log("reCAPTCHA Response:", recaptchaResponse);

        // if (!recaptchaResponse) {
        //     $scope.errors = {
        //         "g-recaptcha-response": ["Vui lòng xác nhận reCAPTCHA"],
        //     };
        //     return;
        // }

        var data = {
            email: $scope.email,
            password: $scope.password,
            // "g-recaptcha-response": recaptchaResponse, // Gửi token ngay sau khi tạo
        };

        // try {
        //     var response = await $http.post("/api/auth/login", data);
        //     console.log(response.data);
        // } catch (error) {
        //     if (error.status == 422) {
        //         $scope.$apply(() => {
        //             $scope.errors = error.data.error;
        //         });
        //     }
        //     console.log(error);
        // }
        try {
            let response = await $http.post("/auth/login", data);

            Swal.fire({
                icon: "success",
                title: "Đăng nhập thành công!",
                text: "Chào mừng bạn quay trở lại.",
                timer: 2000,
                showConfirmButton: false,
            });

            setTimeout(() => {
                if (response.data.redirect) {
                    window.location.href = response.data.redirect; // Chuyển trang theo API trả về
                } else {
                    window.location.href = "/home"; // Mặc định về trang home nếu không có redirect
                }
            }, 2000);
        } catch (error) {
            let errorMessage = "Đã xảy ra lỗi, vui lòng thử lại.";

            if (error.status == 422 && error.data.error) {
                if (error.data.error.email) {
                    errorMessage = error.data.error.email[0]; // Lỗi email
                } else if (error.data.error.password) {
                    errorMessage = error.data.error.password[0]; // Lỗi password
                } else {
                    errorMessage = JSON.stringify(error.data.error); // Hiển thị lỗi khác
                }
            }

            Swal.fire({
                icon: "error",
                title: "Lỗi đăng nhập!",
                text: errorMessage,
            });
        }
    };

    $scope.register = async function () {
        try {
            var data = {
                email: $scope.email,
                password: $scope.password,
                name: $scope.name,
            };

            var response = await $http.post("/auth/register", data, config);

            // Hiển thị thông báo thành công
            Swal.fire({
                title: "Đăng ký thành công!",
                text: "Bạn có thể đăng nhập ngay bây giờ.",
                icon: "success",
                confirmButtonText: "OK",
            }).then(() => {
                // Xóa dữ liệu form
                $scope.email = "";
                $scope.password = "";
                $scope.name = "";
                $scope.$apply();
            });
        } catch (error) {
            if (error.status == 422) {
                $scope.$apply(() => {
                    $scope.errors = error.data.error;
                });

                // Hiển thị thông báo lỗi với chi tiết lỗi
                Swal.fire({
                    title: "Lỗi đăng ký!",
                    text:
                        error.data.message ||
                        "Vui lòng kiểm tra lại thông tin.",
                    icon: "error",
                    confirmButtonText: "Thử lại",
                });
            } else {
                console.log(error);
                Swal.fire({
                    title: "Lỗi!",
                    text: "Có lỗi xảy ra, vui lòng thử lại sau.",
                    icon: "error",
                    confirmButtonText: "OK",
                });
            }
        }
    };

    $scope.logout = async function () {
        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Bạn có chắc chắn muốn đăng xuất không?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đăng xuất",
            cancelButtonText: "Hủy",
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    var response = await $http.post("/auth/logout", {}, config);
                    Swal.fire({
                        icon: "success",
                        title: "Đăng xuất thành công!",
                        text: "Hẹn gặp lại bạn!",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    setTimeout(() => {
                        window.location.href = "/home"; // Điều hướng sau khi đăng xuất
                    }, 2000);
                } catch (error) {
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi đăng xuất",
                        text: "Đã xảy ra lỗi khi đăng xuất. Vui lòng thử lại.",
                    });
                    console.log(error);
                }
            }
        });
    };

    const loadSanpham = async function () {
        try {
            var response = await $http.get("/api/load/san-pham-home");
            $scope.sanphams = response.data.data.data;
            console.log($scope.sanphams); // Kiểm tra dữ liệu
            $scope.$apply(); // Cập nhật giao diện
        } catch (error) {
            console.log(error);
        }
    };

    $scope.showQuickView = function (sanpham) {
        const overlay = document.getElementById("quickViewOverlay");
        overlay.classList.add("active");
        document.body.style.overflow = "hidden";
        $scope.deltail = JSON.parse(JSON.stringify(sanpham));
        // Lấy giá trị màu sắc khi cần
        $scope.mauSac = $scope.deltail.color
            ? $scope.deltail.color.name
            : "Không có màu";
        // Kiểm tra trong console
        console.log("Màu sắc sản phẩm:", $scope.mauSac);
    };
    // Đóng popup Xem Nhanh
    document
        .querySelector(".quick-view-close")
        .addEventListener("click", function () {
            document
                .getElementById("quickViewOverlay")
                .classList.remove("active");
            document.body.style.overflow = "auto"; // Cho phép cuộn trang
        });

    // Đóng popup khi click vào overlay
    document
        .getElementById("quickViewOverlay")
        .addEventListener("click", function (e) {
            if (e.target === this) {
                this.classList.remove("active");
                document.body.style.overflow = "auto";
            }
        });
    const loadSize = async function () {
        try {
            const response = await $http.get($scope.urlloadSize);
            $scope.loadSize = response.data.sizes;
            console.log("size:", $scope.loadSize);
            $scope.$applyAsync();
        } catch (error) {
            console.log(error);
        }
    };

    const loadDanhmuc = async function () {
        try {
            const response = await $http.get($scope.urlloadDanhmucHome);
            $scope.danhmucs = response.data.danhmucs;
            $scope.$apply(() => {
                $scope.danhmucs = response.data.danhmucs;
            });
            console.log("danhmuc:", $scope.danhmucs);
        } catch (error) {
            console.log(error);
        }
    };

    loadSanpham();
    loadSize();
    loadDanhmuc();
});
