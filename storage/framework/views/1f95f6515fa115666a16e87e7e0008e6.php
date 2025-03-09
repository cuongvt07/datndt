<div class="page-inner">
  <div
    class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
  >
    <div>
      <h3 class="fw-bold mb-3 ">Trang Chủ</h3>
      <h6 class="op-7 mb-2 ">WD-01-FA24</h6>
    </div>
    <div class="ms-md-auto py-2 py-md-0">
      <a href="#" class="btn btn-label-info btn-round me-2">Quản lý</a>
      <a href="#" class="btn btn-primary btn-round">Thêm khách hàng</a>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div
                class="icon-big text-center icon-primary bubble-shadow-small"
              >
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
              <div
                class="icon-big text-center icon-info bubble-shadow-small"
              >
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
              <div
                class="icon-big text-center icon-success bubble-shadow-small"
              >
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
              <div
                class="icon-big text-center icon-secondary bubble-shadow-small"
              >
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
              <button
                class="btn btn-icon btn-link btn-primary btn-xs"
              >
                <span class="fa fa-angle-down"></span>
              </button>
              <button
                class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"
              >
                <span class="fa fa-sync-alt"></span>
              </button>
              <button
                class="btn btn-icon btn-link btn-primary btn-xs"
              >
                <span class="fa fa-times"></span>
              </button>
            </div>
          </div>
          <p class="card-category">
            Thống kê số sản phẩm theo từng hãng
          </p>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="table-responsive table-hover table-sales">
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
            <div class="col-md-6">
              <div class="mapcontainer">
                <div
                  id="world-map"
                  class="w-100"
                  style="height: 300px"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
</div><?php /**PATH D:\laragon\www\datn1\resources\views/layouts/admin/content.blade.php ENDPATH**/ ?>