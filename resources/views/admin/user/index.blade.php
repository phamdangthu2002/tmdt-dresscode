@extends('admin.layout')

@section('content')
    <title>Quản lý người dùng</title>
    <link href="{{ asset('assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="{{ asset('assets/vendor/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên người dùng</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm người dùng</button>
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
                                    <th>Hình ảnh</th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dữ liệu mẫu -->
                                <tr>
                                    <td><img src="https://via.placeholder.com/50" alt="User 1" class="user-image"></td>
                                    <td>User 1</td>
                                    <td>user1@example.com</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" onclick="editUser(event)"><i class='bx bx-edit'></i></a>
                                        <form action="#" method="POST" onsubmit="deleteUser(event)" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://via.placeholder.com/50" alt="User 2" class="user-image"></td>
                                    <td>User 2</td>
                                    <td>user2@example.com</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" onclick="editUser(event)"><i class='bx bx-edit'></i></a>
                                        <form action="#" method="POST" onsubmit="deleteUser(event)" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://via.placeholder.com/50" alt="User 3" class="user-image"></td>
                                    <td>User 3</td>
                                    <td>user3@example.com</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" onclick="editUser(event)"><i class='bx bx-edit'></i></a>
                                        <form action="#" method="POST" onsubmit="deleteUser(event)" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button>
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
        $(document).ready(function() {
            $('#userTable').DataTable({
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ mục",
                    "zeroRecords": "Không tìm thấy kết quả",
                    "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                    "infoEmpty": "Không có mục nào",
                    "infoFiltered": "(lọc từ _MAX_ mục)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Tiếp",
                        "previous": "Trước"
                    }
                }
            });
        });

        function editUser(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Chỉnh sửa người dùng',
                text: 'Chức năng chỉnh sửa chưa được triển khai.',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        }

        function deleteUser(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Bạn có chắc chắn?',
                text: "Bạn sẽ không thể hoàn tác hành động này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, xóa nó!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Đã xóa!',
                        'Người dùng đã được xóa.',
                        'success'
                    );
                    // Thực hiện hành động xóa ở đây
                    event.target.submit();
                }
            });
        }
    </script>
@endsection