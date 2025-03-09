

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Danh sách bài viết</h1>
        <a href="<?php echo e(route('admin.posts.create')); ?>" class="btn btn-primary">Thêm bài viết mới</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Ngày tạo</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php if($post->image): ?>
                                <img src="<?php echo e(asset('storage/' . $post->image)); ?>" alt="Post Image" width="100">
                            <?php else: ?>
                                Không có ảnh
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($post->title); ?></td>
                        <td><?php echo e($post->content); ?></td>
                        <td><?php echo e($post->created_at->format('d/m/Y')); ?></td>
                        <td><?php echo e($post->category ? $post->category->name : 'Không có danh mục'); ?></td>
                        <td>
                            <!-- Nút Sửa -->
                            <a href="<?php echo e(route('admin.posts.edit', $post->id)); ?>" class="btn btn-warning">Sửa</a>

                            <!-- Form Xóa -->
                            <form action="<?php echo e(route('admin.posts.destroy', $post->id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">Xóa</button>
                            </form>
                            <a href="#" class="btn btn-info">Xem</a>

                            <!-- Có thể thêm các nút sửa và xóa ở đây -->
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>