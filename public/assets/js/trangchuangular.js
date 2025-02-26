var app = angular.module("trangchu", []);
app.controller("CtrlTrangchu", function ($scope, $http) {
    var config = {
        headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer YOUR_ACCESS_TOKEN", // Nếu API yêu cầu token
        },
    };
    $scope.errors = {};
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
            console.log(response.data);
        } catch (error) {
            if (error.status == 422) {
                $scope.$apply(() => {
                    $scope.errors = error.data.error;
                });
            }
            console.log(error);
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
});
