<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Thêm bài viết mới</h1>
        <form action="<?php echo e(route('posts.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" >
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <div class="text-danger"><?php echo e($message); ?></div>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh hoặc Video</label>
                <input type="file" class="form-control" id="image" name="image">
                <input type="text" class="form-control mt-2" id="video" name="video" placeholder="Hoặc nhập URL video YouTube (Nếu có)">
                <div id="videoPreview" class="mt-2"></div>
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>                      
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea id="editor" class="form-control" name="content" rows="10" cols="80">
                    <?php echo e(old('content', $post->content ?? '')); ?></textarea>
                    <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label class="form-label" for="category_id">Danh mục</label>
                <select class="form-control" name="category_id" >
                    <option value="">Chọn danh mục</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <button type="submit" class="btn btn-primary">Thêm bài viết</button>
        </form>

    </div>
<?php $__env->stopSection(); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Cấu hình CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "<?php echo e(route('ckeditor.upload', ['_token' => csrf_token()])); ?>"
            },
            toolbar: [
                'heading', '|', 'bold', 'italic', '|', 'link', '|', 'blockQuote', '|',
                'imageUpload', 'mediaEmbed'
            ],
            mediaEmbed: {
                previewsInData: true
            }
        })
        .catch(error => {
            console.error(error);
        });

    // Hiển thị preview video YouTube
    const videoInput = document.getElementById('video');
    const videoPreview = document.getElementById('videoPreview');

    if (videoInput) {
        videoInput.addEventListener('input', function() {
            const videoUrl = this.value;
            const videoId = videoUrl.match(/(?:youtube\.com\/(?:[^\/]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/);

            if (videoId && videoId[1]) {
                videoPreview.innerHTML = `
                    <iframe width="300" height="200" 
                        src="https://www.youtube.com/embed/${videoId[1]}" 
                        frameborder="0" allowfullscreen>
                    </iframe>`;
            } else {
                videoPreview.innerHTML = '';
            }
        });
    }
});
</script>
<style>
    .ck-editor__editable_inline {
        height: 450px;
    }
</style>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\datn\resources\views/admin/posts/create.blade.php ENDPATH**/ ?>