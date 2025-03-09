<?php $__env->startSection('content'); ?>
    <h1 class="mb-4">Chọn khách hàng để gửi mã giảm giá</h1>

    <!-- Form tìm kiếm -->
    <form class="mb-4">
        <div class="input-group">
            <input type="text" id="search" name="search" class="form-control" placeholder="Tìm theo tên hoặc email..."
                value="<?php echo e(request('search')); ?>">
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </div>
    </form>

    <!-- Danh sách khách hàng -->
    <form action="<?php echo e(route('admin.discount_codes.sendToSelectedUsers')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="discount_code_id" value="<?php echo e($discountCode->id); ?>">

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Chọn</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody id="user-list">
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_users[]" value="<?php echo e($user->id); ?>">
                            </td>
                            <td><?php echo e($user->name_user); ?></td>
                            <td><?php echo e($user->email); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center">Không tìm thấy khách hàng</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-success">Gửi mã giảm giá</button>
    </form>

    <script>
        $(document).ready(function() {
            // Lắng nghe sự kiện khi người dùng nhập vào ô tìm kiếm
            $('#search').on('input', function() {
                var query = $(this).val(); // Lấy giá trị tìm kiếm

                // Gửi yêu cầu AJAX
                $.ajax({
                    url: '<?php echo e(route('admin.discount_codes.selectUsers', $discountCode->id)); ?>', // URL của route
                    type: 'GET',
                    data: {
                        search: query // Gửi từ khóa tìm kiếm
                    },
                    success: function(response) {
                        // Cập nhật lại danh sách khách hàng
                        $('#user-list').html(response);
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn\resources\views/admin/discount_codes/select_users.blade.php ENDPATH**/ ?>