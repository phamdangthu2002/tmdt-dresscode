@extends('admin.layout')

@section('content')
    <title>Trang chủ Admin</title>
    <link href="{{ asset('assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="{{ asset('assets/vendor/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .card-icon {
            font-size: 2.5rem;
            color: #fff;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header .card-title {
            margin: 0;
        }
    </style>

    <div class="container mt-5">
        <h1 class="mb-4">Bảng điều khiển</h1>

        <div class="row">
            <!-- Thẻ thông tin -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Người dùng</h5>
                        <i class='bx bx-user card-icon'></i>
                    </div>
                    <div class="card-body">
                        <h3 class="card-text">1,234</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Doanh thu</h5>
                        <i class='bx bx-dollar-circle card-icon'></i>
                    </div>
                    <div class="card-body">
                        <h3 class="card-text">$12,345</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Đơn hàng</h5>
                        <i class='bx bx-cart card-icon'></i>
                    </div>
                    <div class="card-body">
                        <h3 class="card-text">567</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Sản phẩm bán chạy</h5>
                        <i class='bx bx-line-chart card-icon'></i>
                    </div>
                    <div class="card-body">
                        <h3 class="card-text">8,910</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Biểu đồ -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Doanh thu hàng tháng</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Sản phẩm bán chạy</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Danh sách sản phẩm bán chạy -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Danh sách sản phẩm bán chạy</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng bán</th>
                                    <th>Doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sản phẩm 1</td>
                                    <td>100</td>
                                    <td>$1,000</td>
                                </tr>
                                <tr>
                                    <td>Sản phẩm 2</td>
                                    <td>200</td>
                                    <td>$2,000</td>
                                </tr>
                                <tr>
                                    <td>Sản phẩm 3</td>
                                    <td>150</td>
                                    <td>$1,500</td>
                                </tr>
                                <!-- Thêm các sản phẩm khác ở đây -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Biểu đồ doanh thu hàng tháng
        var ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                datasets: [{
                    label: 'Doanh thu',
                    data: [1200, 1900, 3000, 5000, 2300, 3200, 4100, 2900, 3300, 4500, 3800, 5200],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Biểu đồ sản phẩm bán chạy
        var ctxTopProducts = document.getElementById('topProductsChart').getContext('2d');
        var topProductsChart = new Chart(ctxTopProducts, {
            type: 'bar',
            data: {
                labels: ['Sản phẩm 1', 'Sản phẩm 2', 'Sản phẩm 3', 'Sản phẩm 4', 'Sản phẩm 5'],
                datasets: [{
                    label: 'Số lượng bán',
                    data: [100, 200, 150, 80, 120],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
