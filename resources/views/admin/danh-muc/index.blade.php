@extends('admin.layout')
@section('content')
    <title>Quản lý danh mục</title>
    <link href="{{ asset('assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="{{ asset('assets/vendor/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <style>
        .category-image {
            width: 100px;
            height: 100px;
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên danh mục</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm danh mục</button>
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
                                    <td><img src="https://via.placeholder.com/100" alt="Category 1" class="category-image"></td>
                                    <td>Category 1</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" onclick="editCategory(event)"><i class='bx bx-edit'></i></a>
                                        <form action="#" method="POST" onsubmit="deleteCategory(event)" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://via.placeholder.com/100" alt="Category 2" class="category-image"></td>
                                    <td>Category 2</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" onclick="editCategory(event)"><i class='bx bx-edit'></i></a>
                                        <form action="#" method="POST" onsubmit="deleteCategory(event)" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://via.placeholder.com/100" alt="Category 3" class="category-image"></td>
                                    <td>Category 3</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" onclick="editCategory(event)"><i class='bx bx-edit'></i></a>
                                        <form action="#" method="POST" onsubmit="deleteCategory(event)" style="display:inline;">
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
            $('#categoryTable').DataTable({
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

        function editCategory(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Chỉnh sửa danh mục',
                text: 'Chức năng chỉnh sửa chưa được triển khai.',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        }

        function deleteCategory(event) {
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
                        'Danh mục đã được xóa.',
                        'success'
                    );
                    // Thực hiện hành động xóa ở đây
                    event.target.submit();
                }
            });
        }
    </script>
@endsection
