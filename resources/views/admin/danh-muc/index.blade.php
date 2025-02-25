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




        /* Định dạng form */
        form {
            font-family: Arial, sans-serif;
            padding: 15px;
        }

        /* Định dạng nhóm input */
        .form-group {
            margin-bottom: 15px;
        }

        /* Nhãn input */
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        /* Input, textarea, select */
        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        /* Căn chỉnh textarea */
        textarea {
            height: 80px;
            resize: vertical;
        }

        /* Input file */
        input[type="file"] {
            padding: 5px;
        }

        /* Ảnh xem trước */
        img {
            max-width: 200px;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
            border: 1px solid #ddd;
            padding: 5px;
            background: #f8f8f8;
        }

        /* Nút bấm */
        button {
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        /* Nút lưu */
        .btn-primary {
            background: blue;
            color: white;
        }

        /* Nút đóng */
        .btn-secondary {
            background: gray;
            color: white;
        }

        /* Hiệu ứng hover */
        .btn-primary:hover {
            background: darkblue;
        }

        .btn-secondary:hover {
            background: darkgray;
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
                                <div ng-if="errors.ten_danh_muc" class="form-text text-danger">
                                    @{{ errors.ten_danh_muc[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="mo_ta" class="form-label">Mô tả</label>
                                <input type="text" class="form-control" id="mo_ta" name="mo_ta"
                                    ng-model="danhmuc.mo_ta">
                                <div ng-if="errors.mo_ta" class="form-text text-danger">
                                    @{{ errors.mo_ta[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="danh_muc_id" class="form-label">Danh mục cha</label>
                                <select name="danh_muc_id" id="danh_muc_id" class="form-control" ng-model="danhmuc.danh_muc_id">
                                    <option value="">-- Chọn danh mục cha --</option>
                                    <option ng-repeat="danhmuc in parent_id" value="@{{ danhmuc.id }}">
                                        @{{ danhmuc.ten_danh_muc }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="trang_thai" class="form-label">Trạng thái</label>
                                <select name="trang_thai" id="trang_thai" class="form-control"
                                    ng-model="danhmuc.trang_thai">
                                    <option value="">-- Chọn trạng thái --</option>
                                    <option value="active">Hiển thị</option>
                                    <option value="inactive">Tạm khóa</option>
                                </select>
                                <div ng-if="errors.trang_thai" class="form-text text-danger">
                                    @{{ errors.trang_thai[0] }}
                                </div>
                            </div>
                            <input type="file" class="form-control" id="image" accept="image/*"
                                onchange="angular.element(this).scope().previewImage(event)">

                            <!-- Hiển thị ảnh xem trước -->
                            <img ng-show="danhmuc.hinh_anh_preview" ng-src="@{{ danhmuc.hinh_anh_preview }}" alt="Xem trước hình ảnh"
                                style="max-width: 200px; margin-top: 10px;">

                            <!-- Hiển thị tên file -->
                            <p ng-show="danhmuc.hinh_anh">Tên file: @{{ danhmuc.hinh_anh }}</p>
                            <div ng-if="errors.hinh_anh" class="form-text text-danger">
                                @{{ errors.hinh_anh[0] }}
                            </div>
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
                        <!-- Bảng danh mục -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Mô tả</th>
                                    <th>Trạng Thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Mảng danh mục rỗng -->
                                <div ng-if="loadDanhmucs.length === 0" class="alert alert-warning" role="alert">
                                    <i class="bx bx-info-circle"></i> Hiện tại chưa có danh mục nào. Hãy thêm một danh mục
                                    mới!
                                </div>
                                <tr ng-repeat="danhmuc in loadDanhmucs">
                                    <td>@{{ danhmuc.id }}</td>
                                    <td><img ng-src="@{{ danhmuc.hinh_anh }}" alt=""
                                            style="width: 50px;height: 50px;"></td>
                                    <td>@{{ danhmuc.ten_danh_muc }}</td>
                                    <td>@{{ danhmuc.mo_ta }}</td>
                                    <td>
                                        <span ng-if="danhmuc.trang_thai === 'active'">
                                            <p class="badge text-success">Hoạt động</p>
                                        </span>
                                        <span ng-if="danhmuc.trang_thai === 'inactive'">
                                            <p class="badge text-danger">Tạm khóa</p>
                                        </span>
                                    </td>
                                    <td>
                                        <a ng-click="editDanhmuc(danhmuc)" class="btn btn-warning"><i
                                                class="bx bx-edit"></i></a>
                                        <a ng-click="deleteDanhmuc(danhmuc.id)" class="btn btn-danger"><i
                                                class="bx bx-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item" ng-class="{ disabled: pagination.current_page === 1 }">
                                    <a class="page-link" href="#"
                                        ng-click="changePage(pagination.current_page - 1)">Trước</a>
                                </li>
                                <li class="page-item" ng-class="{ active: n === pagination.current_page }"
                                    ng-repeat="n in paginationRange() track by $index">
                                    <a class="page-link" href="#"
                                        ng-click="changePage(n)">@{{ n }}</a>
                                </li>
                                <li class="page-item"
                                    ng-class="{ disabled: pagination.current_page === pagination.last_page }"> <a
                                        class="page-link" href="#"
                                        ng-click="changePage(pagination.current_page + 1)">Sau</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sửa Danh Mục -->
    <div class="modal fade" id="editDanhmucModal" tabindex="-1" aria-labelledby="editDanhmucLabel" aria-hidden="true"
        data-backdrop="false" data-keyboard="true">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDanhmucLabel">Chỉnh sửa Danh Mục</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="tenDanhMuc">Tên Danh Mục</label>
                            <input type="text" class="form-control" id="tenDanhMuc"
                                ng-model="selectedDanhmuc.ten_danh_muc">
                            <div ng-if="errors.ten_danh_muc" class="form-text text-danger">
                                @{{ errors.ten_danh_muc[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="moTa">Mô Tả</label>
                            <textarea class="form-control" id="moTa" ng-model="selectedDanhmuc.mo_ta"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="trangThai">Trạng Thái</label>
                            <select class="form-control" id="trangThai" ng-model="selectedDanhmuc.trang_thai">
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Tạm khóa</option>
                            </select>
                            <div ng-if="errors.trang_thai" class="form-text text-danger">
                                @{{ errors.trang_thai[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="danh_muc_id" class="form-label">Danh mục cha</label>
                            <select name="danh_muc_id" id="danh_muc_id" class="form-control"
                                ng-model="selectedDanhmuc.danh_muc_id">
                                <option value="">-- Chọn danh mục cha --</option>
                                <option ng-repeat="danhmuc in parent_id" ng-value="danhmuc.id">
                                    @{{ danhmuc.ten_danh_muc }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hinh_anh">Hình ảnh</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" class="form-control" id="hinh_anh" accept="image/*"
                                        onchange="angular.element(this).scope().previewImage_edit(event)">
                                    <div ng-if="errors.hinh_anh" class="form-text text-danger">
                                        @{{ errors.hinh_anh[0] }}
                                    </div>
                                    <label>Ảnh xem trước</label>
                                    <img ng-show="danhmuc.hinh_anh_preview_edit" ng-src="@{{ danhmuc.hinh_anh_preview_edit }}"
                                        alt="Xem trước hình ảnh" style="max-width: 200px; margin-top: 10px;">
                                    <img ng-show="selectedDanhmuc.hinh_anh_preview_edit" ng-src="@{{ selectedDanhmuc.hinh_anh_preview_edit }}"
                                        alt="Xem trước hình ảnh" style="max-width: 200px; margin-top: 10px;">
                                </div>
                                <div class="col-md-6">
                                    <label>Ảnh đã lưu</label>
                                    <img ng-src="@{{ selectedDanhmuc.hinh_anh }}" alt="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" ng-click="updateDanhmuc()">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
@endsection
