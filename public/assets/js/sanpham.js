app.controller("CtrlDetail", function ($scope, $http) {
    var config = {
        headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer YOUR_ACCESS_TOKEN", // Nếu API yêu cầu token
        },
    };
    $scope.urlloadSanpham = "/api/load/san-pham";
    const user_id = document.getElementById("user_id").value;
    console.log("userid:", user_id);

    $scope.errors = {};
    $scope.sanphams = [];
    $scope.detail = [];
    $scope.loadSize = [];
    $scope.mauSac = {};
    $scope.danhmucs = [];
    $scope.selectedSize = null; // Khởi tạo biến này để tránh lỗi undefined

    $scope.urlloadSize = "/api/load/size";
    $scope.urlloadDanhmucHome = "/api/load/danh-muc-home";
    $scope.urladdTocart = "/api/add/cart";
    $scope.urldeTail = "/detail";

    $scope.quantity = 1; // Giá trị mặc định
    $scope.size = [];

    $scope.changeImage = function (url) {
        $scope.detail.anhsp = url;
    };

    $scope.selectSize = function (size) {
        console.log("Size đã chọn:", size); // Debug để kiểm tra dữ liệu
        $scope.selectedSize = size.id;
    };

    $scope.increaseQuantity = function () {
        $scope.quantity++; // Tăng số lượng
    };

    $scope.decreaseQuantity = function () {
        if ($scope.quantity > 1) {
            $scope.quantity--; // Giảm số lượng nhưng không nhỏ hơn 1
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

    // Hàm tăng số lượng
    $scope.increaseQuantity = function () {
        if (!$scope.cart) $scope.cart = {};
        $scope.cart.so_luong = ($scope.cart.so_luong || 1) + 1;
    };

    // Hàm giảm số lượng
    $scope.decreaseQuantity = function () {
        if (!$scope.cart) $scope.cart = {};
        if ($scope.cart.so_luong > 1) {
            $scope.cart.so_luong -= 1;
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
    const detail = function () {
        $scope.san_pham_id = window.location.pathname.split("/").pop();
        console.log("san_pham_id:", $scope.san_pham_id);

        $http.get($scope.urlloadSanpham + "/" + $scope.san_pham_id).then(
            function (response) {
                $scope.detail = response.data.data;
                console.log($scope.detail);
            },
            function (error) {
                console.log(error);
            }
        );
    };
    detail();
    loadDanhmuc();
    loadSize();
});
