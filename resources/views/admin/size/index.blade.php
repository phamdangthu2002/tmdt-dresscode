@extends('admin.layout')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Quản lý size</h1>
        <div class="row">
            <!-- Form thêm danh mục -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Thêm size</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.size.add') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="ten_danh_muc" class="form-label">Tên Size</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm Size</button>
                        </form>
                    </div>
                </div>
                @include('admin.size.update')
            </div>

            <!-- Danh sách danh mục -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Danh sách size</h2>
                    </div>
                    <div class="card-body">
                        <!-- Bảng danh mục -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên size</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sizes as $size)
                                    <tr>
                                        <td>{{ $size->id }}</td>
                                        <td>{{ $size->name }}</td>
                                        <td>
                                            <a href="/api/size/{{ $size->id }}" class="btn btn-warning"><i
                                                    class="bx bx-edit"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-danger"
                                                onclick="confirmDelete({{ $size->id }})">
                                                <i class="bx bx-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                @if ($sizes->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Trước</span></li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $sizes->previousPageUrl() }}" rel="prev">Trước</a>
                                    </li>
                                @endif

                                @foreach ($sizes->getUrlRange(1, $sizes->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $sizes->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($sizes->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $sizes->nextPageUrl() }}" rel="next">Sau</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Sau</span></li>
                                @endif
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Bạn có chắc chắn muốn xóa?",
                text: "Hành động này không thể hoàn tác!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Xóa ngay!",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/size/delete/" + id;
                }
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                Swal.fire({
                    title: "Thành công!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: "Lỗi!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            @endif
        });
    </script>
@endsection
