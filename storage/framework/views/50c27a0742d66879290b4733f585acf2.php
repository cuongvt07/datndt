<?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="message-container <?php echo e($message->from_admin ? 'received' : 'sent'); ?>">
        <div class="message-header">
            <strong>
                <?php if($message->from_admin): ?>
                    Nhân viên hỗ trợ
                <?php else: ?>
                    <?php echo e($message->user_id ? $userName : 'Khách'); ?>

                <?php endif; ?>
            </strong>
        </div>
        <?php if(!empty($message->message)): ?>
            <div class="message-content">
                <p><?php echo e($message->message); ?></p>
            </div>
        <?php endif; ?>
        <?php $__currentLoopData = $message->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(strpos($media->media_type, 'image') !== false): ?>
                <img src="<?php echo e(asset('storage/' . $media->media_path)); ?>" alt="Image" class="media-item">
            <?php elseif(strpos($media->media_type, 'video') !== false): ?>
                <video width="320" height="240" controls class="media-item">
                    <source src="<?php echo e(asset('storage/' . $media->media_path)); ?>" type="<?php echo e($media->media_type); ?>">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="message-time">
            <small><?php echo e($message->created_at->format('Y-m-d H:i:s')); ?></small>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p>Chưa có tin nhắn nào.</p>
<?php endif; ?>
<?php /**PATH D:\laragon\www\datn1\resources\views/partials/chat-messages.blade.php ENDPATH**/ ?>