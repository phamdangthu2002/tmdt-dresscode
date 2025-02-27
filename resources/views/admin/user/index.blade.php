@extends('admin.layout')

@section('content')
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    <style>
        .user-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-card {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .user-card img {
            margin-right: 10px;
        }

        .user-card .user-info {
            flex: 1;
        }

        .user-card .user-actions {
            display: flex;
            gap: 10px;
        }
    </style>

    <div class="container mt-5">
        <h1 class="mb-4">Quản lý người dùng</h1>
        <div class="row">
            <!-- Form thêm người dùng -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Thêm người dùng</h2>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên người dùng</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    ng-model="user.name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    ng-model="user.email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    ng-model="user.password">
                            </div>
                            <input type="file" class="form-control" id="image" accept="image/*"
                                onchange="angular.element(this).scope().previewImage(event)">

                            <!-- Hiển thị ảnh xem trước -->
                            <img ng-show="user.avatar_preview" ng-src="@{{ user.avatar_preview }}" alt="Xem trước hình ảnh"
                                style="max-width: 200px; margin-top: 10px;">

                            <!-- Hiển thị tên file -->
                            <p ng-show="user.avatar">Tên file: @{{ user.avatar }}</p>
                            <button type="submit" class="btn btn-primary" ng-click="addUser()">Thêm người dùng</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Danh sách người dùng -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Danh sách người dùng</h2>
                    </div>
                    <div class="card-body">
                        <table id="userTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dữ liệu mẫu -->
                                <div ng-if="loadUsers.length === 0" class="alert alert-warning" role="alert">
                                    <i class="bx bx-info-circle"></i> Hiện tại chưa có danh mục nào. Hãy thêm một danh mục
                                    mới!
                                </div>
                                <tr ng-repeat="user in loadUsers">
                                    <td>@{{ user.id }}</td>
                                    <td><img ng-src="@{{ user.avatar }}" alt=""
                                            style="width: 50px;height: 50px;">
                                    </td>
                                    <td>@{{ user.name }}</td>
                                    <td>@{{ user.email }}</td>
                                    <td>
                                        <span ng-if="user.trang_thai === 'active'">
                                            <p class="badge text-success">Hoạt động</p>
                                        </span>
                                        <span ng-if="user.trang_thai === 'inactive'">
                                            <p class="badge text-danger">Tạm khóa</p>
                                        </span>
                                    </td>
                                    <td>
                                        <a ng-click="editUser(user)" class="btn btn-warning"><i class="bx bx-edit"></i></a>
                                        <a ng-click="deleteUser(user.id)" class="btn btn-danger"><i
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
                                        ng-click="changePageUser(pagination.current_page - 1)">Trước</a>
                                </li>
                                <li class="page-item" ng-class="{ active: n === pagination.current_page }"
                                    ng-repeat="n in paginationRangeUser() track by $index">
                                    <a class="page-link" href="#"
                                        ng-click="changePageUser(n)">@{{ n }}</a>
                                </li>
                                <li class="page-item"
                                    ng-class="{ disabled: pagination.current_page === pagination.last_page }"> <a
                                        class="page-link" href="#"
                                        ng-click="changePageUser(pagination.current_page + 1)">Sau</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true"
        data-backdrop="false" data-keyboard="true">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserLabel">Chỉnh sửa Danh Mục</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Tên Người Dùng</label>
                                    <input type="text" class="form-control" ng-model="selectUser.name">
                                    <div ng-if="errors.name" class="form-text text-danger">
                                        @{{ errors.name[0] }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" ng-model="selectUser.email" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" ng-model="selectUser.password_new"
                                placeholder="Nếu có thay đổi">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Vai Trò</label>
                                    <select class="form-control" id="role" ng-model="selectUser.role">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sex">Sex</label>
                                    <select class="form-control" id="sex" ng-model="selectUser.sex">
                                        <option value="male">Nam</option>
                                        <option value="female">Nữ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Số Điện Thoại</label>
                                    <input type="text" class="form-control" ng-model="selectUser.phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Địa Chỉ</label>
                                    <input type="text" class="form-control" ng-model="selectUser.address">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trangThai">Trạng Thái</label>
                            <select class="form-control" id="trangThai" ng-model="selectUser.trang_thai">
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Tạm khóa</option>
                            </select>
                            <div ng-if="errors.trang_thai" class="form-text text-danger">
                                @{{ errors.trang_thai[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" class="form-control" id="avatar" accept="image/*"
                                        onchange="angular.element(this).scope().previewImage_edit(event)">
                                    <div ng-if="errors.avatar" class="form-text text-danger">
                                        @{{ errors.avatar[0] }}
                                    </div>
                                    <label>Ảnh xem trước</label>
                                    <img ng-show="user.avatar_preview_edit" ng-src="@{{ user.avatar_preview_edit }}"
                                        alt="Xem trước hình ảnh" style="max-width: 200px; margin-top: 10px;">
                                    <img ng-show="selectUser.avatar_preview_edit" ng-src="@{{ selectUser.avatar_preview_edit }}"
                                        alt="Xem trước hình ảnh" style="max-width: 200px; margin-top: 10px;">
                                </div>
                                <div class="col-md-6">
                                    <label>Ảnh đã lưu</label>
                                    <img ng-src="@{{ selectUser.avatar }}" alt="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" ng-click="updateUser()">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
@endsection
