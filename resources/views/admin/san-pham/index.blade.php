@extends('admin.layout')

@section('content')
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    <style>
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .product-card {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .product-card img {
            margin-right: 10px;
        }

        .product-card .product-info {
            flex: 1;
        }

        .product-card .product-actions {
            display: flex;
            gap: 10px;
        }
    </style>

    <div class="container mt-5">
        <h1 class="mb-4">Quản lý sản phẩm</h1>
        <div class="row">
            <!-- Form thêm sản phẩm -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Thêm sản phẩm</h2>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="tensp" class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="tensp" name="tensp"
                                    ng-model="sanphams.tensp">
                                <div ng-if="errors.tensp" class="form-text text-danger">
                                    @{{ errors.tensp[0] }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="mo_ta">Mô tả</label>
                                <input class="form-control" id="mo_ta" name="mo_ta" ng-model="sanphams.mo_ta">
                            </div>
                            <div class="mb-3">
                                <label for="mota_chitiet">Mô tả chi tiết</label>
                                <textarea class="form-control" id="mota_chitiet" name="mota_chitiet" ng-model="sanphams.mota_chitiet"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="gia_goc" class="form-label">Giá</label>
                                        <input type="number" class="form-control" id="gia_goc" name="gia_goc"
                                            ng-model="sanphams.gia_goc">
                                        <div ng-if="errors.gia_goc" class="form-text text-danger">
                                            @{{ errors.gia_goc[0] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="gia_km_phan_tram" class="form-label">% Giảm</label>
                                        <input type="number" class="form-control" id="gia_km_phan_tram"
                                            name="gia_km_phan_tram" ng-model="sanphams.gia_km_phan_tram">
                                        <div ng-if="errors.gia_km_phan_tram" class="form-text text-danger">
                                            @{{ errors.gia_km_phan_tram[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="color" class="form-label">Color</label>
                                        <select class="form-select" id="color_id" name="color_id"
                                            ng-model="sanphams.color_id">
                                            <option value="">--Chọn màu sắc--</option>
                                            <option ng-repeat="color in loadColor" value="@{{ color.id }}">
                                                @{{ color.name }}</option>
                                        </select>
                                        <div ng-if="errors.color_id" class="form-text text-danger">
                                            @{{ errors.color_id[0] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3">
                                        <label for="danh_muc_id ">Danh mục</label>
                                        <select class="form-select" id="danh_muc_id" name="danh_muc_id"
                                            ng-model="sanphams.danh_muc_id">
                                            <option value="">--Chọn danh mục--</option>
                                            <option ng-repeat="danhmuc in parent_id" value="@{{ danhmuc.id }}">
                                                @{{ danhmuc.ten_danh_muc }}
                                            </option>
                                        </select>
                                        <div ng-if="errors.danh_muc_id" class="form-text text-danger">
                                            @{{ errors.danh_muc_id[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="anhsp" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" id="anhsp" accept="image/*"
                                    onchange="angular.element(this).scope().uploadToServer(event)" multiple
                                    ng-model="sanphams.anhsp">
                                <div ng-if="errors.anhsp" class="form-text text-danger">
                                    @{{ errors.anhsp[0] }}
                                </div>
                            </div>
                            <div id="anhsp_preview" class="d-flex flex-wrap mt-2">
                                <img ng-repeat="img in previewImages" ng-src="@{{ img }}"
                                    class="img-thumbnail m-1" width="100">
                            </div>

                            <button type="submit" class="btn btn-primary" ng-click="addSanpham()">Thêm sản phẩm</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Danh sách sản phẩm -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Danh sách sản phẩm</h2>
                    </div>
                    <div class="card-body">
                        <table id="productTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>% KM</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dữ liệu mẫu -->
                                <tr ng-repeat="sanpham in loadSanphams">
                                    <td>@{{ sanpham.id }}</td>
                                    <td><img ng-src="@{{ sanpham.anhsp }}" width="50"></td>
                                    <td>@{{ sanpham.tensp }}</td>
                                    <td>@{{ sanpham.gia_goc | number }}VND</td>
                                    <td>@{{ sanpham.gia_km_phan_tram }}%</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" ng-click="editSanpham(sanpham)"><i
                                                class="bx bx-edit"></i></a>
                                        <a href="#" class="btn btn-danger" ng-click="deleteSanpham(sanpham.id)"><i
                                                class="bx bx-trash"></i></a>
                                    </td>
                                </tr>
                                <!-- Kết thúc dữ liệu mẫu -->
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item" ng-class="{ disabled: pagination.current_page === 1 }">
                                    <a class="page-link" href="#"
                                        ng-click="changePageSanpham(pagination.current_page - 1)">Trước</a>
                                </li>
                                <li class="page-item" ng-class="{ active: n === pagination.current_page }"
                                    ng-repeat="n in paginationRangeSanpham() track by $index">
                                    <a class="page-link" href="#"
                                        ng-click="changePageSanpham(n)">@{{ n }}</a>
                                </li>
                                <li class="page-item"
                                    ng-class="{ disabled: pagination.current_page === pagination.last_page }"> <a
                                        class="page-link" href="#"
                                        ng-click="changePageSanpham(pagination.current_page + 1)">Sau</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 🟢 Modal Sửa Sản Phẩm -->
    <!-- Modal Sửa Sản Phẩm -->
    <div class="modal fade" id="editSanphamModal" tabindex="-1" aria-labelledby="editSanphamLabel" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSanphamLabel">Sửa Sản Phẩm</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" class="form-control" ng-model="selectedSanpham.tensp">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Danh mục sản phẩm</label>
                                <div class="form-group">
                                    <select class="form-control" id="danhmuc_id" ng-model="selectedSanpham.danh_muc_id">
                                        <option ng-repeat="danhmuc in loadDanhmucs" ng-value="danhmuc.id">
                                            @{{ danhmuc.ten_danh_muc }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Giá gốc</label>
                                    <input type="number" class="form-control" ng-model="selectedSanpham.gia_goc">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Giá khuyến mãi (%)</label>
                                    <input type="number" class="form-control"
                                        ng-model="selectedSanpham.gia_km_phan_tram">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="size" class="form-label">Color</label>
                                    <select class="form-select" ng-model="selectedSanpham.color">
                                        <option ng-repeat="color in loadColor" ng-value="color.id">
                                            @{{ color.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mo_ta">Mô tả</label>
                            <input type="text" class="form-control" name="mo_ta" ng-model="selectedSanpham.mo_ta">
                        </div>
                        <div class="form-group">
                            <label for="mota_chitiet">Mô tả chi tiết</label>
                            <textarea class="form-control" name="mota_chitiet" ng-model="selectedSanpham.mota_chitiet"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <!-- Input chọn ảnh mới -->
                            <input type="file" class="form-control" id="hinh_anh" accept="image/*"
                                onchange="angular.element(this).scope().previewImage_sanpham(event)">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Hiển thị ảnh gốc -->
                                    <label>Ảnh gốc</label>
                                    <img ng-src="@{{ selectedSanpham.anhsp }}" width="80">
                                </div>
                                <div class="col-md-6">
                                    <!-- Xem trước ảnh mới -->
                                    <label>Ảnh mới</label>
                                    <div class="preview mt-2">
                                        <img ng-show="selectedSanpham.anhsp_preview" ng-src="@{{ selectedSanpham.anhsp_preview }}"
                                            alt="Xem trước hình ảnh" width="80">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" ng-click="updateSanpham()">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
@endsection
