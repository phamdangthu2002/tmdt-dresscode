var app = angular.module("myApp", []);
app.controller("CtrlAdmin", function ($scope, $http) {
    var config = {
        headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer YOUR_ACCESS_TOKEN", // Nếu API yêu cầu token
        },
    };
    $scope.error = [];
    $scope.loadDanhmucs = [];
    $scope.pagination = {};
    $scope.selectedDanhmuc = [];
    $scope.parent_id = [];

    // Lấy danh sách danh mục
    $scope.urlDanhmuc = "/api/add/danh-muc";
    $scope.urlLoadDanhmuc = "/api/load/danh-muc";
    $scope.loadParent = "/api/load/parent/danh-muc";
    $scope.urlUpload = "/api/upload/file";
    $scope.urlUpdateDanhmuc = "/api/update/danh-muc";
    $scope.urlDeleteDanhmuc = "/api/delete/danh-muc";
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
        let input = event.target;
        if (input.files && input.files[0]) {
            let file = input.files[0];

            // 1️⃣ Đọc file để hiển thị trước
            let reader = new FileReader();
            reader.onload = function (e) {
                $scope.$applyAsync(() => {
                    // Dùng $applyAsync để tránh lỗi
                    $scope.danhmuc.hinh_anh_preview = e.target.result;
                });
            };
            reader.readAsDataURL(file);

            // 2️⃣ Tạo FormData để upload ảnh lên server
            let formData = new FormData();
            formData.append("file", file);

            // 3️⃣ Gửi file lên server
            $http
                .post($scope.urlUpload, formData, {
                    headers: { "Content-Type": undefined },
                    transformRequest: angular.identity,
                })
                .then((response) => {
                    console.log("Upload thành công!", response.data);
                    $scope.danhmuc.hinh_anh = response.data.url; // Lưu đường dẫn ảnh từ server
                })
                .catch((error) => {
                    console.error("Lỗi upload:", error);
                });
        }
    };
    $scope.previewImage_edit = function (event) {
        let input = event.target;
        if (input.files && input.files[0]) {
            let file = input.files[0];

            // 1️⃣ Đọc file để hiển thị trước
            let reader = new FileReader();
            reader.onload = function (e) {
                $scope.$applyAsync(() => {
                    // Dùng $applyAsync để tránh lỗi
                    $scope.selectedDanhmuc.hinh_anh_preview_edit =
                        e.target.result;
                });
            };
            reader.readAsDataURL(file);

            // 2️⃣ Tạo FormData để upload ảnh lên server
            let formData = new FormData();
            formData.append("file", file);

            // 3️⃣ Gửi file lên server
            $http
                .post($scope.urlUpload, formData, {
                    headers: { "Content-Type": undefined },
                    transformRequest: angular.identity,
                })
                .then((response) => {
                    console.log("Upload thành công!", response.data);
                    $scope.selectedDanhmuc.hinh_anh_edit = response.data.url; // Lưu đường dẫn ảnh từ server
                })
                .catch((error) => {
                    console.error("Lỗi upload:", error);
                });
        }
    };

    // Gửi danh mục lên server (bỏ hinh_anh_preview)
    $scope.addDamhmuc = async function () {
        try {
            let dataToSend = angular.copy($scope.danhmuc);
            delete dataToSend.hinh_anh_preview; // Xóa dữ liệu không cần thiết trước khi gửi

            // Gửi request thêm danh mục
            let response = await $http.post(
                $scope.urlDanhmuc,
                dataToSend,
                config
            );

            console.log("Thêm danh mục thành công:", response.data);

            // Đảm bảo UI cập nhật ngay lập tức
            $scope.$apply(() => {
                $scope.danhmuc = {}; // Reset form
                $scope.errors = {}; // Xóa lỗi nếu có trước đó
            });
            getDanhmuc(); // Lấy danh sách danh mục mới nhất
        } catch (error) {
            $scope.$apply(() => {
                if (error.status === 422) {
                    $scope.errors = error.data.error; // Lưu lỗi để hiển thị trong form
                    console.log($scope.errors);
                }
            });
            console.error("Lỗi khi thêm danh mục:", error);
        }
    };

    // Lấy danh sách danh mục
    const loadParent = async function () {
        try {
            let response = await $http.get($scope.loadParent, config);
            $scope.parent_id = response.data.parent_id; // Gán dữ liệu đúng cách
            console.log("Danh sách danh mục id:", $scope.parent_id);
            $scope.$applyAsync(); // Cập nhật UI một cách nhẹ nhàng
        } catch (error) {
            console.error("Lỗi khi lấy danh mục:", error);
        }
    };

    const getDanhmuc = async function (page = 1) {
        try {
            const response = await $http.get(
                $scope.urlLoadDanhmuc + "?page=" + page
            );

            // Cập nhật dữ liệu danh mục
            $scope.loadDanhmucs = response.data.danhmucs.data;
            $scope.pagination = {
                current_page: response.data.danhmucs.current_page,
                last_page: response.data.danhmucs.last_page,
                total: response.data.danhmucs.total,
                per_page: response.data.danhmucs.per_page,
            };

            console.log(
                "Danh sách danh mục:",
                response.data.danhmucs.current_page
            );

            // ✅ Cập nhật UI ngay lập tức
            $scope.$apply();

            console.log($scope.loadDanhmucs);
        } catch (error) {
            console.log(error);
        }
    };

    $scope.paginationRange = function () {
        const maxVisiblePages = 3; // số trang hiển thị nhiều nhất
        const pages = [];
        const current = $scope.pagination.current_page;
        const last = $scope.pagination.last_page;
        if (last <= maxVisiblePages) {
            for (let i = 1; i <= last; i++) {
                pages.push(i);
            }
        } else {
            let start = Math.max(current - Math.floor(maxVisiblePages / 2), 1);
            let end = start + maxVisiblePages - 1;
            if (end > last) {
                end = last;
                start = end - maxVisiblePages + 1;
            }
            if (start > 1) {
                pages.push(1);
                if (start > 2) {
                    pages.push("...");
                }
            }
            for (let i = start; i <= end; i++) {
                pages.push(i);
            }
            if (end < last) {
                if (end < last - 1) {
                    pages.push("...");
                }
                pages.push(last);
            }
        }
        return pages;
    };
    $scope.changePage = function (page) {
        if (page === "..." || page < 1 || page > $scope.pagination.last_page) {
            return;
        }
        getDanhmuc(page);
    };
    $scope.editDanhmuc = function (danhmuc) {
        $scope.selectedDanhmuc = JSON.parse(JSON.stringify(danhmuc)); // Sao chép thông tin người dùng để chỉnh sửa
        console.log($scope.selectedDanhmuc);
        $(".modal").modal("hide"); // Đóng tất cả modal trước khi mở
        $("#editDanhmucModal").modal("show"); // Hiển thị modal chỉnh sửa danh mục
    };

    $scope.updateDanhmuc = async function () {
        let dataToSend = angular.copy($scope.selectedDanhmuc);
        delete dataToSend.hinh_anh_preview_edit; // Xóa dữ liệu không cần thiết trước khi gửi

        await $http
            .put(
                $scope.urlUpdateDanhmuc + "/" + $scope.selectedDanhmuc.id,
                dataToSend
            )
            .then(function (response) {
                if (response.data.message) {
                    $("#editDanhmucModal").modal("hide"); // Đóng modal
                    getDanhmuc($scope.pagination.current_page); // Cập nhật danh sách

                    // ✅ Cập nhật giao diện ngay lập tức
                    $scope.$applyAsync();

                    Swal.fire({
                        title: "Thành công!",
                        text: "Thông tin danh mục đã được cập nhật thành công.",
                        icon: "success",
                        timer: 1500,
                    });
                }
            })
            .catch(function (error) {
                if (error.status === 422) {
                    $scope.errors = error.data.error;
                    console.log($scope.errors);
                }
                console.error("Lỗi khi cập nhật danh mục:", error);
                Swal.fire({
                    title: "Lỗi!",
                    text: "Không thể cập nhật thông tin danh mục. Vui lòng thử lại sau.",
                    icon: "error",
                });
            });
    };

    $scope.deleteDanhmuc = function (id) {
        Swal.fire({
            title: "Xác nhận",
            text: "Bạn có chắc chắn muốn xóa danh mục này?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Xóa",
            cancelButtonText: "Hủy",
        }).then((result) => {
            if (result.isConfirmed) {
                $http
                    .delete($scope.urlDeleteDanhmuc + "/" + id)
                    .then(function (response) {
                        if (response.data.message) {
                            Swal.fire({
                                title: "Đã xóa!",
                                text: "Danh mục đã được xóa thành công.",
                                icon: "success",
                                timer: 1500,
                            }).then(() => {
                                getDanhmuc();
                            });
                        }
                    })
                    .catch(function (error) {
                        console.error("Lỗi khi xóa danh mục:", error);
                        Swal.fire({
                            title: "Lỗi!",
                            text: "Không thể xóa danh mục. Vui lòng thử lại sau.",
                            icon: "error",
                        });
                    });
            }
        });
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

    // Cập nhật danh mục
    loadParent();
    getDanhmuc(); // Lấy danh sách danh mục ngay khi ứng dụng bắt đầu
});
