<?php $__env->startSection('content'); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>
        <h1>Thống kê chi tiết</h1>
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <!-- Form chọn thời gian chung -->
                    <div class="mt-4">
                        <form method="GET" action="<?php echo e(route('admin.annalist')); ?>">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <label for="start_date">Từ ngày:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        value="<?php echo e($startDate); ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="end_date">Đến ngày:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"
                                        value="<?php echo e($endDate); ?>">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary mt-3">Lọc</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="bi bi-box"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tổng Số Sản Phẩm Có Trong Kho</p>
                                        <h4 class="card-title"><?php echo e($totalProducts); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tài Khoản Mới Trong 1 Tháng</p>
                                        <h4 class="card-title"><?php echo e($totalNewUsers); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-luggage-cart"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tổng Số Đơn Hàng Đã Giải Quyết</p>
                                        <h4 class="card-title"><?php echo e($completedOrders); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="bi bi-graph-up-arrow"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Tính Tổng Doanh Thu Đạt Được</p>
                                        <h4 class="card-title"><?php echo e(number_format($totalRevenue)); ?> VND</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Thống Kê</h4>
                                <div class="card-tools">
                                    <button class="btn btn-icon btn-link btn-primary btn-xs">
                                        <span class="fa fa-angle-down"></span>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card">
                                        <span class="fa fa-sync-alt"></span>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-primary btn-xs">
                                        <span class="fa fa-times"></span>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="container mt-4">
                                        <div class="table-responsive table-hover table-sales">
                                            <h3 class="fw-bold mb-4"> Thống kê số sản phẩm theo từng hãng</h3>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nhà Cung Cấp</th>
                                                        <th>Dòng sản phẩm</th>
                                                        <th>Tổng Số Lượng Sản Phẩm</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($supplier->name); ?></td>
                                                            <td><?php echo e($supplier->brand); ?></td>
                                                            <td><?php echo e($supplier->total_stock); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="container mt-4">
                                        <h3 class="fw-bold mb-4">Thống kê Sản phẩm Theo Nhà Cung Cấp và Loại Sản Phẩm</h3>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Tỷ lệ sản phẩm theo Nhà Cung Cấp</h5>
                                                <canvas id="supplierPieChart"></canvas>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Tỷ lệ sản phẩm theo Loại Sản Phẩm</h5>
                                                <canvas id="categoryPieChart"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Thêm Chart.js -->
                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            // Dữ liệu từ backend cho Pie Chart nhà cung cấp
                                            const supplierLabels = <?php echo json_encode(array_keys($supplierData)); ?>; // Tên nhà cung cấp
                                            const supplierData = <?php echo json_encode(array_values($supplierData)); ?>; // Số lượng sản phẩm

                                            // Biểu đồ Pie Chart cho nhà cung cấp
                                            const supplierCtx = document.getElementById('supplierPieChart').getContext('2d');
                                            const supplierPieChart = new Chart(supplierCtx, {
                                                type: 'pie',
                                                data: {
                                                    labels: supplierLabels,
                                                    datasets: [{
                                                        data: supplierData,
                                                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                                                    }]
                                                },
                                                options: {
                                                    responsive: true,
                                                    plugins: {
                                                        legend: {
                                                            position: 'bottom',
                                                        },
                                                        tooltip: {
                                                            callbacks: {
                                                                label: function(context) {
                                                                    return `${context.label}: ${context.raw} sản phẩm`;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            });

                                            // Dữ liệu từ backend cho Pie Chart loại sản phẩm
                                            const categoryLabels = <?php echo json_encode(array_keys($categoryData)); ?>; // Tên loại sản phẩm
                                            const categoryData = <?php echo json_encode(array_values($categoryData)); ?>; // Số lượng sản phẩm

                                            // Biểu đồ Pie Chart cho loại sản phẩm
                                            const categoryCtx = document.getElementById('categoryPieChart').getContext('2d');
                                            const categoryPieChart = new Chart(categoryCtx, {
                                                type: 'pie',
                                                data: {
                                                    labels: categoryLabels,
                                                    datasets: [{
                                                        data: categoryData,
                                                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                                                    }]
                                                },
                                                options: {
                                                    responsive: true,
                                                    plugins: {
                                                        legend: {
                                                            position: 'bottom',
                                                        },
                                                        tooltip: {
                                                            callbacks: {
                                                                label: function(context) {
                                                                    return `${context.label}: ${context.raw} sản phẩm`;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            });
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-4 ms-5">
                                            <h3>Top 3 Sản Phẩm Bán Chạy Nhất</h3>
                                            <?php if($topProducts->isEmpty()): ?>
                                                <p>Không có sản phẩm bán chạy trong khoảng thời gian đã chọn.</p>
                                            <?php else: ?>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>ID Sản Phẩm</th>
                                                            <th>Tên Sản Phẩm</th>
                                                            <th>Tổng Số Lượng Bán</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($product->id); ?></td>
                                                                <td><?php echo e($product->name_sp); ?></td>
                                                                <td><?php echo e($product->total_sold); ?></td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-4 ms-4">
                                            <h2>Danh sách các sản phẩm ít được quan tâm</h2>

                                            <?php if($unpopularProducts->isEmpty()): ?>
                                                <p>Không có sản phẩm nào có số lượng đặt hàng dưới 3 hoặc chưa có đơn hàng
                                                    nào.</p>
                                            <?php else: ?>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Tên sản phẩm</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $unpopularProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($product->id); ?></td>
                                                                <td><?php echo e($product->name_sp); ?></td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            <?php endif; ?>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Thêm phần form chọn ngày và biểu đồ Chart.js vào đây -->
                <div class="row mt-12">
                    <div class="col-md-6">
                        <div class="card card-round1">
                            <div class="card-header">
                                <h4 class="card-title">Biểu Đồ Số Lượng Sản Phẩm Nhập Theo Ngày</h4>
                            </div>
                            <!-- Biểu đồ Chart.js -->
                            <div>
                                <canvas id="productChart"></canvas>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Dữ liệu từ backend
                                    const labels = <?php echo json_encode($allDates); ?>; // Danh sách đủ 15 ngày
                                    const data = <?php echo json_encode($data); ?>; // Tổng stock sản phẩm mỗi ngày

                                    const ctx = document.getElementById('productChart').getContext('2d');
                                    const productChart = new Chart(document.getElementById('productChart').getContext('2d'), {
                                        type: 'line',
                                        data: {
                                            labels: <?php echo json_encode($allDates); ?>,
                                            datasets: [{
                                                label: 'Tổng số lượng sản phẩm nhập theo ngày',
                                                data: <?php echo json_encode($data); ?>,
                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                fill: true,
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                x: {
                                                    title: {
                                                        display: true,
                                                        text: 'Ngày'
                                                    }
                                                },
                                                y: {
                                                    title: {
                                                        display: true,
                                                        text: 'Số lượng sản phẩm'
                                                    },
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });

                                });
                            </script>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card card-round1">
                            <div class="card-header">
                                <h4 class="card-title">Biểu Đồ Số Lượng Tài Khoản Khách Hàng Tạo Mới Trong Khoảng Thời Gian</h4>
                            </div>
                            <!-- Biểu đồ Chart.js -->
                            <div>
                                <canvas id="userChart"></canvas>
                            </div>
                    
                            <!-- JavaScript Chart.js -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Lấy dữ liệu từ backend cho biểu đồ khách hàng mới
                                    const userLabels = <?php echo json_encode($allDates); ?>; // Danh sách ngày từ start_date đến end_date
                                    const userCounts = <?php echo json_encode($userCounts); ?>; // Số lượng khách hàng mới tương ứng
                    
                                    // Tạo biểu đồ đường (line chart)
                                    const ctx = document.getElementById('userChart').getContext('2d');
                                    const userChart = new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: userLabels, // Danh sách ngày
                                            datasets: [{
                                                label: 'Lượng khách hàng mới tạo tài khoản',
                                                data: userCounts, // Số lượng khách hàng mới
                                                borderColor: 'rgba(153, 102, 255, 1)',
                                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                                fill: true,
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                x: {
                                                    title: {
                                                        display: true,
                                                        text: 'Ngày'
                                                    }
                                                },
                                                y: {
                                                    title: {
                                                        display: true,
                                                        text: 'Số lượng tài khoản mới'
                                                    },
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    
                </div>

                <div class="row mt-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <h4 class="card-title">Biểu Đồ Doanh Thu Trong 1 Tháng</h4>
                        </div>
                        
                        <!-- Biểu đồ doanh thu Chart.js -->
                        <div>
                            <canvas id="revenueChart"></canvas>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Dữ liệu từ backend cho biểu đồ doanh thu
                                const revenueChart = new Chart(document.getElementById('revenueChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: <?php echo json_encode($allDates); ?>,
        datasets: [{
            label: 'Doanh thu hàng ngày',
            data: <?php echo json_encode($revenueCounts); ?>,
            borderColor: 'rgba(255, 159, 64, 1)',
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            fill: true,
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: { title: { display: true, text: 'Ngày' }},
            y: { title: { display: true, text: 'Doanh thu (VNĐ)' }, beginAtZero: true }
        }
    }
});

                            });
                        </script>

                    </div>
                </div>

            </div>
        </div>
    </body>

    </html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LARAGON-PHP2\laragon\www\datn\resources\views/admin/annalist.blade.php ENDPATH**/ ?>