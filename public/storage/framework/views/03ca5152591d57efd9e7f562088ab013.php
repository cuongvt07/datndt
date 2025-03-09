<?php $__env->startSection('content'); ?>
    <h2 style="margin-top: 100px;margin-left: 600px;">Quản lý đơn hàng</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <div class="col-12 mb-3 search-bar">
        <form id="search-form" action="<?php echo e(route('admin.orders')); ?>" method="GET" style="margin-top: 30px">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo e(request()->input('keyword')); ?>" name="keyword"
                        id="keyword" placeholder="Tìm kiếm đơn hàng...">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>

   

<div class="container mt-5">
    
    <h3 class="order-title" style="color: rgb(208, 208, 20)">Đơn hàng đang xử lý</h3>
    <a href="<?php echo e(route('admin.orders.completed')); ?>" class="btn btn-success">Đơn hàng đã hoàn thành</a>
    <a href="<?php echo e(route('admin.orders.canceled')); ?>" class="btn btn-primary">Đơn hàng đã hủy</a>
    <table class="table table-hover mt-3">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Người đặt</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Sản phẩm</th>
                <th>phí ship</th>
                <th>Tổng giá</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($order->status == 'pending' || $order->status == 'delivering'): ?>
                    <tr>
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->user->name_user); ?></td>
                        <td><?php echo e($order->phone); ?></td>
                        <td><?php echo e($order->detail_address); ?></td>
                        <td>
                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($item->product->name_sp); ?><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td>
                            <strong><?php echo e(number_format($order->shipping_fee, 0, ',', '.')); ?> ₫</strong>
                        </td>
                        <td>
                            <strong><?php echo e(number_format($order->grand_total, 0, ',', '.')); ?> ₫</strong>
                        </td>
                        <td>
                            <span class="badge badge-warning">
                                <?php echo e($order->status == 'pending' ? 'Đang xử lý' : 'Đang giao hàng'); ?>

                            </span>
                        </td>
                        <td><a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-info btn-sm">Chi tiết</a></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>


    
</div>

<style>
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    .badge-success {
        background-color: #28a745;
        color: white;
    }
</style>




    



 
   
    <script>
        $(document).ready(function() {
            $('.btn[data-bs-toggle="collapse"]').click(function() {
                $(this).find('i').toggleClass('bi-plus bi-dash');
            });
        });
    </script>
    <style>
        .order-container {
            border: 1px solid #c4c7cb;
            width: 1500px;
            margin-left: 50px;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #ffffffe2;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }


        .order-title {
            margin-bottom: 20px;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            padding: 0.5em 0.75em;
            border-radius: 20px;
            color: white;
        }

        .status-pending {
            background-color: #ffc107;
            /* Yellow */
        }

        .status-delivering {
            background-color: #17a2b8;
            /* Teal */
        }

        .status-completed {
            background-color: #28a745;
            /* Green */
        }

        .status-canceled {
            background-color: #dc3545;
            /* Red */
        }

        .search-bar {
            margin-bottom: 20px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>