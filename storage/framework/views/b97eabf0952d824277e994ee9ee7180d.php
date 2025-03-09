<ul class="chat-user-list" style="list-style: none; padding: 0; margin: 0;">
    <?php $__currentLoopData = $chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="chat-user-item" style="margin-bottom: 10px;">
            <a href="javascript:void(0)" class="chat-user-link"
                data-id="<?php echo e($chat->user_id ?: $chat->session_id); ?>"
                data-type="<?php echo e($chat->user_id ? 'user' : 'session'); ?>"
                style="display: flex; align-items: center; text-decoration: none; color: #333; padding: 10px; border-radius: 5px; background-color: #ffffff; border: 1px solid #ddd; position: relative;">
                <div style="flex-grow: 1;">
                    <strong><?php echo e($chat->display_name); ?></strong>
                    <br>
                    <small>IP: <?php echo e($chat->ip_address ?? 'Không có'); ?></small>
                </div>
                <?php if($chat->unread_count > 0): ?>
                    <div class="notification-badge" data-unread="<?php echo e($chat->unread_count); ?>">
                        <h6>
                            <span class="badge bg-dark" style="border-radius:20px;">
                                <span><?php echo e($chat->unread_count); ?></span>
                            </span>
                        </h6>
                    </div>
                <?php endif; ?>
                <small style="color: #999; margin-left: 10px;">
                    <?php echo e($chat->time_diff); ?>

                </small>
            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH D:\ProjectDT\datn\datn\resources\views/admin/chat/sidebar.blade.php ENDPATH**/ ?>