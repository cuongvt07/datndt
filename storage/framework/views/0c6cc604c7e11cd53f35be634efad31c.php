<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Danh sách bài viết</h1>
        <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-primary">Thêm bài viết mới</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Ảnh / Video</th>
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
                            <?php if($post->video): ?>
                                <!-- Nếu có video, hiển thị video -->
                                <div class="video-container">
                                    <!-- Đảm bảo rằng video có ID đúng và URL YouTube được cấu hình đúng -->
                                    <iframe width="80px" height="80px"
                                        src="https://www.youtube.com/embed/<?php echo e(\Illuminate\Support\Str::after($post->video, 'v=')); ?>"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                            <?php elseif($post->image): ?>
                                <!-- Nếu không có video, hiển thị ảnh -->
                                <img src="<?php echo e(asset('storage/' . $post->image)); ?>" alt="Post Image" width="80px"
                                    height="80px">
                            <?php else: ?>
                                Không có ảnh hoặc video
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($post->title); ?></td>
                        <td>
                            <?php echo \Illuminate\Support\Str::limit(strip_tags($post->content, '<p><a><strong><em><ul><li><ol>'), 50, '...'); ?>

                        </td>                                                
                        <td><?php echo e($post->created_at->format('d/m/Y')); ?></td>
                        <td><?php echo e($post->category ? $post->category->name : 'Không có danh mục'); ?></td>
                        <td>
                            <!-- Nút Sửa -->
                            <a href="<?php echo e(route('posts.edit', $post->id)); ?>" class="btn btn-warning">Sửa</a>

                            <!-- Form Xóa -->
                            <form action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">Xóa</button>
                            </form>
                            <a href="<?php echo e(route('posts.show', ['id' => $post->id])); ?>" class="btn btn-info">Xem</a>

                            <!-- Có thể thêm các nút sửa và xóa ở đây -->
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<script>
    // Hàm này giúp trích xuất ID của video YouTube từ URL
    function extractYouTubeId(url) {
        const regExp =
            /(?:youtube\.com\/(?:[^\/]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
        const match = url.match(regExp);
        return match ? match[1] : null;
    }
    // 
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "<?php echo e(route('ckeditor.upload', ['_token' => csrf_token()])); ?>"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>