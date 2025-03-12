@extends('admin.layout')
@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
        }

        .card {
            border-radius: 10px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn {
            border-radius: 5px;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .pending {
            background-color: #ffc107;
            color: #fff;
        }

        .completed {
            background-color: #28a745;
            color: #fff;
        }

        .canceled {
            background-color: #dc3545;
            color: #fff;
        }
    </style>

    <div class="container">
        <div class="row">
            <!-- Danh sách đơn hàng -->
            <div class="col-md-7">
                <div class="card p-3">
                    <h4>Danh sách đơn hàng</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Khách hàng</th>
                                <th>Số tiền</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Nguyễn Văn A</td>
                                <td>1,500,000 VND</td>
                                <td><span class="status-badge pending">Chờ xác nhận</span></td>
                                <td><button class="btn btn-primary btn-sm">Xem</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Trần Thị B</td>
                                <td>2,000,000 VND</td>
                                <td><span class="status-badge completed">Hoàn thành</span></td>
                                <td><button class="btn btn-primary btn-sm">Xem</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Chi tiết đơn hàng -->
            <div class="col-md-5">
                <div class="card p-3">
                    <h4>Chi tiết đơn hàng</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>iPhone 14 Pro</td>
                                <td>1</td>
                                <td>25,000,000 VND</td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="mt-3">Cập nhật trạng thái</h5>
                    <select class="form-select">
                        <option>Chờ xác nhận</option>
                        <option>Đang vận chuyển</option>
                        <option>Hoàn thành</option>
                        <option>Hủy</option>
                    </select>
                    <button class="btn btn-success mt-2">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
@endsection
