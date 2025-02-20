@extends('admin.layout')

@section('content')
    <title>Quản lý sản phẩm</title>
    <link href="{{ asset('assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="{{ asset('assets/vendor/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Giá</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
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
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dữ liệu mẫu -->
                                <tr>
                                    <td><img src="https://placehold.co/100" alt="Product 1" class="product-image"></td>
                                    <td>Product 1</td>
                                    <td>$100</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" onclick="editProduct(event)"><i class='bx bx-edit'></i></a>
                                        <form action="#" method="POST" onsubmit="deleteProduct(event)" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://placehold.co/100" alt="Product 2" class="product-image"></td>
                                    <td>Product 2</td>
                                    <td>$200</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" onclick="editProduct(event)"><i class='bx bx-edit'></i></a>
                                        <form action="#" method="POST" onsubmit="deleteProduct(event)" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://placehold.co/100" alt="Product 3" class="product-image"></td>
                                    <td>Product 3</td>
                                    <td>$150</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" onclick="editProduct(event)"><i class='bx bx-edit'></i></a>
                                        <form action="#" method="POST" onsubmit="deleteProduct(event)" style="display:inline;">
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
            $('#productTable').DataTable({
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

        function editProduct(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Chỉnh sửa sản phẩm',
                text: 'Chức năng chỉnh sửa chưa được triển khai.',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        }

        function deleteProduct(event) {
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
                        'Sản phẩm đã được xóa.',
                        'success'
                    );
                    // Thực hiện hành động xóa ở đây
                    event.target.submit();
                }
            });
        }
    </script>
@endsection
