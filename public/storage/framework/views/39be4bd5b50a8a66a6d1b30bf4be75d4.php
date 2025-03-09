<?php echo $__env->make('layouts.user.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('layouts.user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bài viết</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- blog main wrapper start -->
    <div class="blog-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="blog-sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h5 class="title">Tìm kiếm</h5>
                            <div class="sidebar-serch-form">
                                <form action="#">
                                    <input type="text" class="search-field" placeholder="search here">
                                    <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div> <!-- single sidebar end -->
                        <div class="blog-sidebar">
                            <h5 class="title">Danh mục</h5>
                            <ul class="blog-archive blog-category">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('user.posts.category', $category->id)); ?>">
                                            <?php echo e($category->name); ?> (<?php echo e($category->posts_count); ?>)
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <!-- single sidebar end -->
                        <div class="blog-sidebar">
                            <h5 class="title">Lưu trữ bài viết</h5>
                            <ul class="blog-archive">
                                <?php $__currentLoopData = $archives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a
                                            href="<?php echo e(route('user.posts.archive', ['year' => $archive->year, 'month' => str_pad($archive->month, 2, '0', STR_PAD_LEFT)])); ?>">
                                            <?php echo e(\Carbon\Carbon::create()->year($archive->year)->month($archive->month)->format('F Y')); ?>

                                            (<?php echo e($archive->count); ?>)
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <!-- single sidebar end -->
                        <div class="blog-sidebar">
                            <h5 class="title">Bài viết gần đây</h5>
                            <div class="recent-post">
                                <?php $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="recent-post-item">
                                        <figure class="product-thumb1">
                                            <a href="<?php echo e(route('user.posts.show', $recentPost->id)); ?>">
                                                <!-- Sử dụng hình ảnh của bài viết -->
                                                <img src="<?php echo e(asset('storage/' . $recentPost->image)); ?>"
                                                    alt="<?php echo e($recentPost->title); ?>">
                                            </a>
                                        </figure>
                                        <div class="recent-post-description">
                                            <div class="product-name">
                                                <h6><a
                                                        href="<?php echo e(route('user.posts.show', $recentPost->id)); ?>"><?php echo e($recentPost->title); ?></a>
                                                </h6>
                                                <p><?php echo e($recentPost->created_at->format('F d, Y')); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div> <!-- single sidebar end -->
                        <div class="blog-sidebar">
                            <h5 class="title">Tags</h5>
                            <ul class="blog-tags">
                                <li><a href="#">camera</a></li>
                                <li><a href="#">computer</a></li>
                                <li><a href="#">bag</a></li>
                                <li><a href="#">watch</a></li>
                                <li><a href="#">smartphone</a></li>
                                <li><a href="#">shoes</a></li>
                            </ul>
                        </div> <!-- single sidebar end -->
                    </aside>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="blog-item-wrapper">
                        <!-- blog item wrapper end -->
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row mbn-30">
                                <div class="col-md-6">
                                    <!-- blog post item start -->
                                    <div class="blog-post-item mb-30">
                                        <figure class="blog-thumb">
                                            <a href="<?php echo e(route('user.posts.show', $post->id)); ?>">
                                                <img src="<?php echo e(asset('storage/' . $post->image)); ?>"
                                                    alt="<?php echo e($post->title); ?>">
                                            </a>
                                        </figure>
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <p><?php echo e($post->created_at->format('d/m/Y')); ?> | <a href="#">Tác
                                                        giả</a></p>
                                            </div>
                                            <h4 class="blog-title">
                                                <a
                                                    href="<?php echo e(route('user.posts.show', $post->id)); ?>"><?php echo e($post->title); ?></a>
                                            </h4>
                                            <p><?php echo e(\Illuminate\Support\Str::limit($post->content, 100, '...')); ?></p>
                                        </div>
                                    </div>
                                    <!-- blog post item end -->
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- blog item wrapper end -->

                        <!-- start pagination area -->
                        <div class="paginatoin-area text-center">
                            <ul class="pagination-box">
                                <li><a class="previous" href="#"><i class="pe-7s-angle-left"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a class="next" href="#"><i class="pe-7s-angle-right"></i></a></li>
                            </ul>
                        </div>
                        <!-- end pagination area -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog main wrapper end -->
</main>
<?php echo $__env->make('layouts.user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
    .blog-thumb img {
        width: 100%;
        object-fit: cover;
        border-radius: 8px;
        /* Thêm góc bo tròn nếu cần */
    }

    .recent-post {}

    .recent-post-item {
        margin-bottom: 15px;
    }

    .product-thumb1 {
        width: 100%;
        max-width: 80px;
        height: auto;
    }

    .recent-post-description {
        padding-left: 10px;
    }

    .product-name h6 {
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
    }

    .product-name p {
        font-size: 12px;
        color: #777;
        margin: 5px 0 0;
    }
</style>
<?php /**PATH C:\laragon\www\datn\resources\views/user/post/index.blade.php ENDPATH**/ ?>