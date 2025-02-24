@extends('admin.layout')
@section('content')
    <title>Quản lý danh mục</title>
    <style>
        .category-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .category-card {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .category-card img {
            margin-right: 10px;
        }

        .category-card .category-info {
            flex: 1;
        }

        .category-card .category-actions {
            display: flex;
            gap: 10px;
        }
    </style>

    <div class="container mt-5">
        <h1 class="mb-4">Quản lý danh mục</h1>
        <div class="row">
            <!-- Form thêm danh mục -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Thêm danh mục</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="ten_danh_muc" class="form-label">Tên danh mục</label>
                                <input type="text" class="form-control" id="ten_danh_muc" name="ten_danh_muc"
                                    ng-model="danhmuc.ten_danh_muc">
                            </div>
                            <div class="mb-3">
                                <label for="mo_ta" class="form-label">Mô tả</label>
                                <input type="text" class="form-control" id="mo_ta" name="mo_ta"
                                    ng-model="danhmuc.mo_ta">
                            </div>
                            <div class="mb-3">
                                <label for="danh_muc_id" class="form-label">Danh mục cha</label>
                                <select name="danh_muc_id" id="danh_muc_id" class="form-control"
                                    ng-model="danhmuc.danh_muc_id">
                                    <option value="">-- Chọn danh mục cha --</option>
                                    <option value="1">Danh mục 1</option>
                                    <option value="2">Danh mục 2</option>
                                    <option value="3">Danh mục 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="trang_thai" class="form-label">Trạng thái</label>
                                <select name="trang_thai" id="trang_thai" class="form-control"
                                    ng-model="danhmuc.trang_thai">
                                    <option value="">-- Chọn trạng thái --</option>
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            <input type="file" class="form-control" id="image" accept="image/*"
                                onchange="angular.element(this).scope().previewImage(event)">

                            <!-- Hiển thị ảnh xem trước -->
                            <img ng-show="danhmuc.hinh_anh_preview" ng-src="@{{ danhmuc.hinh_anh_preview }}" alt="Xem trước hình ảnh"
                                style="max-width: 200px; margin-top: 10px;">

                            <!-- Hiển thị tên file -->
                            <p ng-show="danhmuc.hinh_anh">Tên file: @{{ danhmuc.hinh_anh }}</p>
                            <button type="button" class="btn btn-primary" ng-click="addDamhmuc()">Thêm danh mục</button>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Danh sách danh mục -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Danh sách danh mục</h2>
                    </div>
                    <div class="card-body">
                        <table id="categoryTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên danh mục</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dữ liệu mẫu -->
                                <tr>
                                    <td><img src="https://placehold.co/500" alt="Category 1" class="category-image"></td>
                                    <td>Category 1</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" onclick="editCategory(event)"><i
                                                class='bx bx-edit'></i></a>
                                        <form action="#" method="POST" onsubmit="deleteCategory(event)"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Kết thúc dữ liệu mẫu -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            let input = event.target;
            let preview = document.getElementById("preview");
            let removeBtn = document.getElementById("removeImageBtn");

            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                    removeBtn.style.display = "inline-block"; // Hiện nút xóa
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            let preview = document.getElementById("preview");
            let input = document.getElementById("image");
            let removeBtn = document.getElementById("removeImageBtn");

            preview.src = ""; // Xóa ảnh
            preview.style.display = "none"; // Ẩn ảnh
            input.value = ""; // Xóa giá trị của input file
            removeBtn.style.display = "none"; // Ẩn nút xóa
        }
    </script>
@endsection
