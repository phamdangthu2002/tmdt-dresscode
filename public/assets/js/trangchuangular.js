app.controller("CtrlTrangchu", function ($scope, $http) {
    var config = {
        headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer YOUR_ACCESS_TOKEN", // Nếu API yêu cầu token
        },
    };
    const user_id = document.getElementById("user_id").value;
    console.log("userid:", user_id);

    $scope.errors = {};
    $scope.sanphams = [];
    $scope.detail = [];
    $scope.loadSize = [];
    $scope.mauSac = {};
    $scope.danhmucs = [];
    $scope.danh_muc_id = [];
    $scope.selectedSize = null; // Khởi tạo biến này để tránh lỗi undefined

    $scope.urlloadSize = "/api/load/size";
    $scope.urlloadDanhmucHome = "/api/load/danh-muc-home";
    $scope.urlloadSanphamDanhmuc = "/api/load/san-pham-danhmuc";
    $scope.urladdTocart = "/api/add/cart";
    $scope.urldeTail = "/detail";
    $scope.urlloadSanpham = "/api/load/san-pham";
    $scope.urlloadGiohang = "/api/load/gio-hang";
    $scope.urlgetCountcart = "/api/count-cart";
    $scope.urlloadSanphamRandom = "/api/load/san-pham-random";

    $scope.quantity = []; // Giá trị mặc định
    $scope.size = [];

    $scope.changeImage = function (url) {
        $scope.detail.anhsp = url;
    };

    $scope.selectSize = function (size) {
        console.log("Size đã chọn:", size); // Debug để kiểm tra dữ liệu
        $scope.selectedSize = size.id;
    };

    $scope.cong = function () {
        $scope.quantity++; // Tăng số lượng
        Swal.fire({
            icon: "success",
            title: "Đã tăng số lượng!",
            text: "Số lượng sản phẩm hiện tại: " + $scope.quantity,
            timer: 1000,
            showConfirmButton: false,
        });
    };

    $scope.tru = function () {
        if ($scope.quantity > 1) {
            $scope.quantity--; // Giảm số lượng nhưng không nhỏ hơn 1
            Swal.fire({
                icon: "success",
                title: "Đã giảm số lượng!",
                text: "Số lượng sản phẩm hiện tại: " + $scope.quantity,
                timer: 1000,
                showConfirmButton: false,
            });
        } else {
            Swal.fire({
                icon: "warning",
                title: "Số lượng tối thiểu là 1!",
                text: "Không thể giảm số lượng thấp hơn 1.",
                timer: 1500,
                showConfirmButton: false,
            });
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
        $scope.detail = JSON.parse(JSON.stringify(sanpham));
        // Lấy giá trị màu sắc khi cần
        $scope.mauSac = $scope.detail.color
            ? $scope.detail.color.name
            : "Không có màu";
        // Kiểm tra trong console
        console.log("Màu sắc sản phẩm:", $scope.mauSac);
    };

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

    $scope.addTocart = function (sanpham) {
        if (!user_id) {
            Swal.fire({
                icon: "warning",
                title: "Lưu ý!",
                text: "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!",
            });
            return;
        }

        $scope.cart = {
            user_id: user_id, // Đảm bảo user_id được khai báo
            san_pham_id: sanpham.id,
            so_luong: 1,
            size_id: 1, // Cần chọn size từ giao diện
            gia_goc: sanpham.gia_goc, // API yêu cầu key này
            color_id: 1, // Cần chọn màu từ giao diện
        };

        $http.post($scope.urladdTocart, $scope.cart).then(
            function (response) {
                if (response.data.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công!",
                        text: "Sản phẩm đã được thêm vào giỏ hàng.",
                        timer: 1500,
                        showConfirmButton: false,
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi!",
                        text:
                            response.data.message ||
                            "Không thể thêm vào giỏ hàng.",
                    });
                }
            },
            function (error) {
                console.log(error);
                Swal.fire({
                    icon: "error",
                    title: "Lỗi kết nối!",
                    text: "Không thể kết nối đến server.",
                });
            }
        );

        console.log($scope.cart);
    };

    $scope.closeQuickView = function () {
        document.getElementById("quickViewOverlay").classList.remove("active");
    };

    $scope.increaseQuantity = function () {
        if (!$scope.cart) $scope.cart = {};

        if ($scope.cart.so_luong >= 10) {
            Swal.fire({
                icon: "warning",
                title: "Giới hạn tối đa!",
                text: "Bạn chỉ có thể mua tối đa 10 sản phẩm.",
                timer: 1500,
                showConfirmButton: false,
            });
        } else {
            $scope.cart.so_luong = ($scope.cart.so_luong || 1) + 1;
        }
    };

    $scope.decreaseQuantity = function () {
        if (!$scope.cart) $scope.cart = {};
        if ($scope.cart.so_luong > 1) {
            $scope.cart.so_luong -= 1;
        } else {
            Swal.fire({
                icon: "warning",
                title: "Số lượng tối thiểu là 1!",
                text: "Không thể giảm thêm.",
                timer: 1500,
                showConfirmButton: false,
            });
        }
    };

    // Hàm thêm vào giỏ hàng
    $scope.addToCart = function (detail) {
        if (!user_id) {
            Swal.fire({
                icon: "error",
                title: "Lỗi!",
                text: "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!",
            });
            return;
        }

        if (!$scope.selectedSize) {
            Swal.fire({
                icon: "warning",
                title: "Chưa chọn kích thước!",
                text: "Vui lòng chọn size trước khi thêm vào giỏ hàng.",
            });
            return;
        }

        $scope.cart = {
            user_id: user_id,
            san_pham_id: detail.id,
            so_luong: $scope.cart?.so_luong || 1,
            size_id: $scope.selectedSize,
            color_id: detail.color.id,
            gia_goc: detail.gia_goc,
        };

        console.log("Dữ liệu gửi đi:", $scope.cart);

        $http.post($scope.urladdTocart, $scope.cart).then(
            function (response) {
                if (response.data.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công!",
                        text: "Sản phẩm đã được thêm vào giỏ hàng.",
                        timer: 1500,
                        showConfirmButton: false,
                    });
                    countCart();
                    getGiohang();
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi!",
                        text:
                            response.data.message ||
                            "Không thể thêm vào giỏ hàng.",
                    });
                }
            },
            function (error) {
                console.log(error);
                Swal.fire({
                    icon: "error",
                    title: "Lỗi kết nối!",
                    text: "Không thể kết nối đến server.",
                });
            }
        );
    };

    $scope.sanPham = function (sanpham) {
        localStorage.setItem("san_pham", JSON.stringify(sanpham));
        setTimeout(function () {
            window.location.href = $scope.urldeTail + "/" + sanpham.id;
        }, 100); // Đợi 100ms để đảm bảo dữ liệu lưu xong
    };

    // Hàm lấy sản phẩm từ localStorage khi trang tải lại
    const chitiet = function () {
        var sanPham = JSON.parse(localStorage.getItem("san_pham"));
        if (sanPham) {
            $scope.detail = sanPham;
            console.log("Lấy sản phẩm từ localStorage:", sanPham);
        } else {
            console.error("Không tìm thấy sản phẩm trong localStorage!");
        }
    };

    const loadSanphamDanhmuc = async function () {
        var sanPham = JSON.parse(localStorage.getItem("san_pham"));
        $scope.danh_muc_id = sanPham.danh_muc_id;
        try {
            var response = await $http.get(
                "/api/load/san-pham-danhmuc/" + $scope.danh_muc_id
            );
            $scope.sanphams = response.data.data;
            console.log($scope.sanphams); // Kiểm tra dữ liệu
            $scope.$apply(); // Cập nhật giao diện
        } catch (error) {
            console.log(error);
        }
    };

    const getGiohang = async function () {
        try {
            var response = await $http.get(
                $scope.urlloadGiohang + "/" + user_id
            );
            $scope.giohangs = response.data.data;

            // Tính tổng giá từ danh sách sản phẩm
            $scope.total = $scope.giohangs.reduce(
                (sum, item) => sum + item.gia * item.so_luong,
                0
            );

            console.log("Giỏ hàng:", $scope.giohangs); // Kiểm tra dữ liệu
            console.log("Tổng giá:", $scope.total);

            $scope.$apply(); // Cập nhật giao diện nếu cần
        } catch (error) {
            console.log("Lỗi khi tải giỏ hàng:", error);
        }
    };

    const countCart = async function () {
        try {
            var response = await $http.get(
                $scope.urlgetCountcart + "/" + user_id
            );
            $scope.countCart = response.data.data;
            console.log("Số lượng giỏ hàng:", $scope.countCart);
            $scope.$apply(); // Cập nhật giao diện
        } catch (error) {
            console.error("Lỗi khi lấy số lượng giỏ hàng:", error);
        }
    };

    const loadSanphamRandom = async function () {
        try {
            var response = await $http.get($scope.urlloadSanphamRandom);
            $scope.sanphamRandoms = response.data.data;
            console.log("San pham random:", $scope.sanphamRandoms);
            $scope.$apply();
        } catch (error) {
            console.log(error);
        }
    };

    loadDanhmuc();
    loadSanpham();
    loadSize();
    chitiet();
    loadSanphamDanhmuc();
    getGiohang();
    countCart();
    loadSanphamRandom();
});
