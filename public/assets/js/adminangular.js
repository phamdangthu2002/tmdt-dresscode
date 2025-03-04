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

    $scope.loadUsers = [];
    $scope.selectUser = [];

    $scope.previewImages = []; // Lưu ảnh xem trước
    $scope.loadSize = [];
    $scope.loadColor = [];

    $scope.loadSanphams = [];
    $scope.selectedSanpham = [];

    $scope.urlUpload = "/api/upload/file";
    $scope.urlUploadMultipleFiles = "/api/upload/files";
    $scope.urlloadSize = "/api/load/size";
    $scope.urlloadColor = "/api/load/color";

    // Lấy danh sách danh mục
    $scope.urlDanhmuc = "/api/add/danh-muc";
    $scope.urlLoadDanhmuc = "/api/load/danh-muc";
    $scope.loadParent = "/api/load/parent/danh-muc";
    $scope.urlUpdateDanhmuc = "/api/update/danh-muc";
    $scope.urlDeleteDanhmuc = "/api/delete/danh-muc";

    // Lấy danh sách người dùng
    $scope.urlUser = "/api/add/user";
    $scope.urlLoadUser = "/api/load/user";
    $scope.urlUpdateUser = "/api/update/user";
    $scope.urlDeleteUser = "/api/delete/user";

    // Lấy danh sách sản phẩm
    $scope.urlAddSanpham = "/api/add/san-pham";
    $scope.urlLoadSanpham = "/api/load/san-pham";
    $scope.urlUpdateSanpham = "/api/update/san-pham";
    $scope.urlDeleteSanpham = "/api/delete/san-pham";

    $scope.danhmuc = {
        ten_danh_muc: "",
        mo_ta: "",
        trang_thai: "",
        danh_muc_id: "",
        hinh_anh: "", // Chỉ lưu tên file
        hinh_anh_preview: "", // Chỉ dùng để hiển thị, không gửi lên server
    };

    $scope.user = {
        name: "",
        email: "",
        password: "",
        avatar: "",
    };

    $scope.sanphams = {
        tensp: "",
        danh_muc_id: "",
        gia_goc: "",
        gia_km_phan_tram: "",
        mo_ta: "",
        mota_chitiet: "",
        color_id: "",
        anhsp: "", // Chỉ lưu tên file
    };

    $scope.uploadToServer = function (event) {
        let files = event.target.files; // Lấy danh sách file từ sự kiện
        if (files.length === 0) return; // Không có file thì thoát luôn

        let formData = new FormData();
        for (let i = 0; i < files.length; i++) {
            let file = files[i];

            // 1️⃣ Đọc ảnh để hiển thị trước
            let reader = new FileReader();
            reader.onload = function (e) {
                $scope.$apply(() => {
                    $scope.previewImages.push(e.target.result);
                });
            };
            reader.readAsDataURL(file);

            // 2️⃣ Thêm file vào formData để gửi lên server
            formData.append("image[]", file);
        }

        // 3️⃣ Gửi request lên server
        $http
            .post($scope.urlUploadMultipleFiles, formData, {
                headers: { "Content-Type": undefined },
                transformRequest: angular.identity,
            })
            .then(function (response) {
                $scope.sanphams.anhsp = response.data.urls;
                console.log("Upload thành công!", response.data);
            })
            .catch(function (error) {
                console.error("Lỗi upload:", error);
            });
    };

    //danh muc

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
                    $scope.user.avatar_preview = e.target.result;
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
                    $scope.user.avatar = response.data.url;
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
                    $scope.selectUser.avatar_preview_edit = e.target.result;
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
                    $scope.selectUser.avatar_edit = response.data.url;
                })
                .catch((error) => {
                    console.error("Lỗi upload:", error);
                });
        }
    };
    $scope.previewImage_sanpham = function (event) {
        let input = event.target;
        if (input.files && input.files[0]) {
            let file = input.files[0];

            // 1️⃣ Đọc file để hiển thị trước
            let reader = new FileReader();
            reader.onload = function (e) {
                $scope.$applyAsync(() => {
                    // Dùng $applyAsync để tránh lỗi
                    $scope.selectedSanpham.anhsp_preview = e.target.result;
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
                    $scope.selectedSanpham.anhsp_edit = response.data.url; // Lưu đường dẫn ảnh từ server
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
                loadParent();
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

            // ✅ Cập nhật UI ngay lập tức
            $scope.$apply();

            console.log($scope.loadDanhmucs);
        } catch (error) {
            console.log(error);
        }
    };

    $scope.paginationRangeDanhmuc = function () {
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
    $scope.paginationRangeUser = function () {
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
    $scope.paginationRangeSanpham = function () {
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
    $scope.changePageDanhmuc = function (page) {
        if (page === "..." || page < 1 || page > $scope.pagination.last_page) {
            return;
        }
        getDanhmuc(page);
    };
    $scope.changePageUser = function (page) {
        if (page === "..." || page < 1 || page > $scope.pagination.last_page) {
            return;
        }
        getUser(page);
    };
    $scope.changePageSanpham = function (page) {
        if (page === "..." || page < 1 || page > $scope.pagination.last_page) {
            return;
        }
        loadSanpham(page);
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

    //user

    $scope.addUser = async function () {
        try {
            let dataToSend = angular.copy($scope.user);
            delete dataToSend.avatar_preview; // Xóa dữ liệu không cần thiết trước khi gửi
            await $http
                .post($scope.urlUser, dataToSend, config)
                .then(function (response) {
                    if (response.data.message) {
                        Swal.fire({
                            title: "Thành công!",
                            text: "Người dùng đã được thêm thành công.",
                            icon: "success",
                            timer: 1500,
                        });
                        $scope.user = {};
                        getUser();
                        $scope.$applyAsync();
                    }
                })
                .catch(function (error) {
                    Swal.fire({
                        title: "Lỗi!",
                        text: "Không thể thêm người dùng. Vui lòng thử lại sau.",
                        icon: "error",
                    });
                    console.error("Lỗi khi thêm người dùng:", error);
                });
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

    const getUser = async function (page = 1) {
        try {
            const response = await $http.get(
                $scope.urlLoadUser + "?page=" + page
            );

            // Cập nhật dữ liệu danh mục
            $scope.loadUsers = response.data.users.data;
            $scope.pagination = {
                current_page: response.data.users.current_page,
                last_page: response.data.users.last_page,
                total: response.data.users.total,
                per_page: response.data.users.per_page,
            };

            // ✅ Cập nhật UI ngay lập tức
            $scope.$applyAsync();

            console.log($scope.loadUsers);
        } catch (error) {
            console.log(error);
        }
    };

    $scope.editUser = async function (user) {
        $scope.selectUser = JSON.parse(JSON.stringify(user)); // Sao chép thông tin người dùng để chỉnh sửa
        console.log($scope.selectUser);
        $(".modal").modal("hide"); // Đóng tất cả modal trước khi mở
        $("#editUserModal").modal("show"); // Hiển thị modal chỉnh sửa danh mục
    };

    $scope.updateUser = async function () {
        let dataToSend = angular.copy($scope.selectUser);
        delete dataToSend.avatar_preview_edit; // Xóa dữ liệu không cần thiết trước khi gửi

        try {
            const response = await $http.put(
                $scope.urlUpdateUser + "/" + $scope.selectUser.id,
                dataToSend
            );

            console.log(response.data);
            getUser(); // Cập nhật danh sách người dùng
            $("#editUserModal").modal("hide"); // Đóng modal chỉnh sửa danh mục
            $scope.selectUser = {}; // Xóa thông tin người dùng đã chỉnh sửa
            $scope.$applyAsync();

            // ✅ Thông báo thành công bằng SweetAlert2
            Swal.fire({
                icon: "success",
                title: "Thành công!",
                text: "Người dùng đã được cập nhật thành công!",
                timer: 2000, // Tự động đóng sau 2 giây
                showConfirmButton: false,
            });
        } catch (error) {
            console.error("Lỗi khi cập nhật người dùng:", error);

            // ❌ Thông báo lỗi bằng SweetAlert2
            Swal.fire({
                icon: "error",
                title: "Lỗi!",
                text: "Cập nhật không thành công, vui lòng thử lại.",
                confirmButtonText: "OK",
            });
        }
    };

    $scope.deleteUser = async function (id) {
        // 🛑 Hiển thị hộp thoại xác nhận trước khi xóa
        const result = await Swal.fire({
            title: "Bạn có chắc chắn muốn xóa?",
            text: "Dữ liệu sẽ không thể khôi phục sau khi xóa!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Xóa",
            cancelButtonText: "Hủy",
        });

        // Nếu người dùng bấm "Hủy" thì dừng lại
        if (!result.isConfirmed) {
            return;
        }

        try {
            const response = await $http.delete(
                $scope.urlDeleteUser + "/" + id
            );
            console.log(response.data);
            getUser(); // Cập nhật danh sách người dùng

            // ✅ Thông báo thành công bằng SweetAlert2
            Swal.fire({
                icon: "success",
                title: "Thành công!",
                text: "Người dùng đã được xóa thành công!",
                timer: 2000, // Tự động đóng sau 2 giây
                showConfirmButton: false,
            });
        } catch (error) {
            console.error("Lỗi khi xóa người dùng:", error);

            // ❌ Thông báo lỗi bằng SweetAlert2
            Swal.fire({
                icon: "error",
                title: "Lỗi!",
                text: "Xóa không thành công, vui lòng thử lại.",
                confirmButtonText: "OK",
            });
        }
    };

    //sanpham
    $scope.addSanpham = async function () {
        try {
            const response = await $http.post(
                $scope.urlAddSanpham,
                $scope.sanphams,
                config
            );

            console.log(response.data);

            // ✅ Hiển thị thông báo thành công bằng SweetAlert2
            Swal.fire({
                icon: "success",
                title: "Thành công!",
                text: "Sản phẩm đã được thêm thành công!",
                timer: 2000,
                showConfirmButton: false,
            });

            // 🔄 Reset dữ liệu chỉ khi thành công
            $scope.sanphams = {};
            $scope.errors = {};
            loadSanpham();
            $scope.$applyAsync();
        } catch (error) {
            console.error("Lỗi khi thêm sản phẩm:", error);

            if (error.status === 422) {
                $scope.errors = error.data.error;
                console.log($scope.errors);
            }

            // ❌ Hiển thị thông báo lỗi bằng SweetAlert2
            Swal.fire({
                icon: "error",
                title: "Lỗi!",
                text: "Thêm không thành công, vui lòng thử lại.",
                confirmButtonText: "OK",
            });
        } finally {
            // 🔄 Dọn dẹp trạng thái hoặc cập nhật lại giao diện nếu cần
            $scope.$applyAsync();
        }
    };

    const loadSanpham = async function (page = 1) {
        try {
            const response = await $http.get(
                $scope.urlLoadSanpham + "?page=" + page
            );

            // Cập nhật dữ liệu danh mục
            $scope.loadSanphams = response.data.data.data;
            $scope.pagination = {
                current_page: response.data.data.current_page,
                last_page: response.data.data.last_page,
                total: response.data.data.total,
                per_page: response.data.data.per_page,
            };

            // ✅ Cập nhật UI ngay lập tức
            $scope.$applyAsync();

            console.log($scope.loadSanphams);
        } catch (error) {
            console.log(error);
        }
    };

    $scope.editSanpham = async function (sanpham) {
        $scope.selectedSanpham = JSON.parse(JSON.stringify(sanpham)); // Sao chép thông tin người dùng để chỉnh sửa
        $scope.selectedSanpham.gia_goc = Number(sanpham.gia_goc) || 0;
        $scope.selectedSanpham.gia_km_phan_tram =
            Number(sanpham.gia_km_phan_tram) || 0;
        console.log($scope.selectedSanpham);
        $(".modal").modal("hide"); // Đóng tất cả modal trước khi mở
        $("#editSanphamModal").modal("show"); // Hiển thị modal chỉnh sửa danh mục
    };

    $scope.updateSanpham = async function () {
        let dataToSend = angular.copy($scope.selectedSanpham);
        delete dataToSend.anhsp_preview; // Xóa dữ liệu không cần thiết trước khi gửi

        try {
            const response = await $http.put(
                $scope.urlUpdateSanpham + "/" + $scope.selectedSanpham.id,
                dataToSend,
                config
            );
            console.log(response);

            // ✅ Cập nhật UI ngay lập tức
            $scope.$applyAsync();

            // ✅ Cập nhật danh sách sản phẩm
            loadSanpham();

            // ✅ Đóng modal
            $("#editSanphamModal").modal("hide");

            // ✅ Hiển thị thông báo với SweetAlert2
            Swal.fire({
                icon: "success",
                title: "Thành công!",
                text: "Sản phẩm đã được cập nhật thành công.",
                showConfirmButton: false,
                timer: 2000, // Tự động tắt sau 2 giây
            });
        } catch (error) {
            console.log(error);

            // ❌ Hiển thị thông báo lỗi
            Swal.fire({
                icon: "error",
                title: "Lỗi!",
                text: "Có lỗi xảy ra khi cập nhật sản phẩm.",
                confirmButtonText: "OK",
            });
        }
    };

    $scope.deleteSanpham = async function (id) {
        Swal.fire({
            title: "Bạn có chắc chắn muốn xóa?",
            text: "Hành động này không thể hoàn tác!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Xóa ngay",
            cancelButtonText: "Hủy",
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await $http.delete(
                        $scope.urlDeleteSanpham + "/" + id,
                        config
                    );
                    console.log(response);

                    // ✅ Cập nhật UI ngay lập tức
                    $scope.$applyAsync();

                    // ✅ Cập nhật danh sách sản phẩm
                    loadSanpham();

                    // ✅ Hiển thị thông báo thành công
                    Swal.fire({
                        icon: "success",
                        title: "Đã xóa!",
                        text: "Sản phẩm đã được xóa thành công.",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                } catch (error) {
                    console.log(error);

                    // ❌ Hiển thị thông báo lỗi
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi!",
                        text: "Có lỗi xảy ra khi xóa sản phẩm.",
                        confirmButtonText: "OK",
                    });
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

    const loadColor = async function () {
        try {
            const response = await $http.get($scope.urlloadColor);
            $scope.loadColor = response.data.colors;
            console.log("color:", $scope.loadColor);
            $scope.$applyAsync();
        } catch (error) {
            console.log(error);
        }
    };

    // Cập nhật danh mục
    loadParent();
    getDanhmuc(); // Lấy danh sách danh mục ngay khi ứng dụng bắt đầu
    getUser();
    loadSanpham();
    loadSize();
    loadColor();
});
