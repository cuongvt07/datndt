<?php $__env->startSection('content'); ?>
<h1>Quản lý đánh giá</h1>
<br>
<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<table class="table table-bordered">
    <thead>
        <tr>
          <th>Người đánh giá</th>
          <th>Email</th>
          <th>Đánh giá</th>
          <th>Nội dung đánh giá</th>
          <th>Ngày tạo</th>
          <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
          <td><?php echo e($review->user->name_user); ?></td>
          <td><?php echo e($review->email); ?></td>
          <td>
            <div class="review-rating">
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <i class="fa fa-star <?php echo e($i <= $review->rating ? 'text-warning' : 'text-muted'); ?>"></i>                <?php endfor; ?>
            </div>
        </td>         
          <td><?php echo e($review->content); ?></td>
          <td> <?php echo e(\Carbon\Carbon::parse($review->created_at)->format('Y-m-d H:i')); ?></td>
          <td>
            <form action="<?php echo e(route('review.destroy', $review->id)); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger" 
                    onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')">Xóa</button>
            </form>
        </td>
        
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<style>
.review-rating i {
    margin-right: 5px; 
    font-size: 20px;   
}
.text-warning {
    color: #FFD700 !important; 
}

.text-muted {
  color: #D3D3D3 !important;
}

.review-rating i:hover {
    color: #FFD700;
    transform: scale(1.2); 
    transition: 0.2s ease-in-out;
}

</style>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn1\resources\views/admin/review/index.blade.php ENDPATH**/ ?>