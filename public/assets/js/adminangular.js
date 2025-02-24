var app = angular.module("myApp", []);
app.controller("CtrlAdmin", function ($scope, $http) {
    var config = {
        headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer YOUR_ACCESS_TOKEN", // Nếu API yêu cầu token
        },
    };

    $scope.url = "/api/add/danh-muc";
    $scope.danhmuc = {
        ten_danh_muc: "",
        mo_ta: "",
        trang_thai: "",
        danh_muc_id: "",
        hinh_anh: "", // Chỉ lưu tên file
        hinh_anh_preview: "", // Chỉ dùng để hiển thị, không gửi lên server
    };

    // Lấy đường dẫn ảnh từ input file
    $scope.previewImage = function (event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $scope.danhmuc.hinh_anh_preview = e.target.result; // Base64 để hiển thị ảnh
                $scope.$apply(); // Cập nhật giao diện
            };
            reader.readAsDataURL(file); // Chuyển ảnh thành base64
            $scope.danhmuc.hinh_anh = file.name; // Chỉ lưu tên file để gửi lên server
        }
    };

    // Gửi danh mục lên server (bỏ hinh_anh_preview)
    $scope.addDamhmuc = function () {
        let dataToSend = angular.copy($scope.danhmuc);
        delete dataToSend.hinh_anh_preview; // Xóa trước khi gửi lên server

        $http.post($scope.url, dataToSend, config).then(
            function (response) {
                console.log("Thêm danh mục thành công:", response.data);
            },
            function (error) {
                console.error("Lỗi khi thêm danh mục:", error);
            }
        );
    };
});
