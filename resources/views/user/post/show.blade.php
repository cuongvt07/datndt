@include('layouts.user.header')

{{-- Menu  --}}
@include('layouts.user.menu')

{{-- Content  --}}
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
                                <li class="breadcrumb-item"><a href="blog-left-sidebar.html">Bài viết</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết bài viết</li>
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
                {{-- Site  --}}
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
                        </div> <!-- Danh mục end -->
                        <div class="blog-sidebar">
                            <h5 class="title">Danh mục</h5>
                            <ul class="blog-archive blog-category">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="#">
                                            {{ $category->name }} ({{ $category->posts_count }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Danh mục end -->
                        <!-- single sidebar end -->
                        <div class="blog-sidebar">
                            <h5 class="title">Lưu trữ bài viết</h5>
                            <ul class="blog-archive">
                                @foreach ($archives as $archive)
                                    <li>
                                        <a
                                            href="{{ route('user.posts.archive', ['year' => $archive->year, 'month' => str_pad($archive->month, 2, '0', STR_PAD_LEFT)]) }}">
                                            {{ \Carbon\Carbon::create()->year($archive->year)->month($archive->month)->format('F Y') }}
                                            ({{ $archive->count }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- single sidebar end -->
                        <div class="blog-sidebar">
                            <h5 class="title">Bài viết gần đây</h5>
                            <div class="recent-post">
                                @foreach ($recentPosts as $recentPost)
                                    <div class="recent-post-item">
                                        <figure class="product-thumb1">
                                            <a href="{{ route('user.posts.show', $recentPost->id) }}">
                                                @if ($recentPost->video)
                                                    <!-- Nếu có video, hiển thị video -->
                                                    <div class="video-container">
                                                        <!-- Đảm bảo rằng video có ID đúng và URL YouTube được cấu hình đúng -->
                                                        <iframe width="80px" height="80px"
                                                            src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($recentPost->video, 'v=') }}"
                                                            frameborder="0" allowfullscreen></iframe>
                                                    </div>
                                                @elseif ($recentPost->image)
                                                    <!-- Nếu không có video, hiển thị ảnh -->
                                                    <img src="{{ asset('storage/' . $recentPost->image) }}"
                                                        alt="Post Image" width="80px" height="80px">
                                                @else
                                                    Không có ảnh hoặc video
                                                @endif
                                            </a>
                                        </figure>
                                        <div class="recent-post-description">
                                            <div class="product-name">
                                                <h6><a
                                                        href="{{ route('user.posts.show', $recentPost->id) }}">{{ $recentPost->title }}</a>
                                                </h6>
                                                <p>{{ $recentPost->created_at->format('F d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- single sidebar end -->
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
                {{-- End site  --}}
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="blog-item-wrapper">
                        <!-- Bài viết -->
                        <div class="blog-post-item blog-details-post">
                            <figure class="blog-thumb">
                                <a href="{{ route('user.posts.show', $post->id) }}">
                                    @if ($post->video)
                                        <div class="blog-thumb">
                                            <iframe 
                                                src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($post->video, 'v=') }}"
                                                frameborder="0" allowfullscreen
                                                width="350px" height="250px"
                                                ></iframe>
                                        </div>
                                    @elseif ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                                            >
                                    @else
                                        <p>Không có ảnh hoặc video</p> 
                                    @endif
                                </a>
                            </figure>
                            <div class="blog-content">
                                <h3 class="blog-title">
                                    {{ $post->title }}
                                </h3>
                                <div class="blog-meta">
                                    <p>{{ $post->created_at->format('d/m/Y') }} | <a href="#">Tác giả</a></p>
                                </div>
                                <div class="entry-summary">
                                    <p>{!! $post->content !!}</p>
                                    <div class="tag-line">
                                        <h6>Tag :</h6>
                                        <a href="#">Necklaces</a>,
                                        <a href="#">Earrings</a>,
                                        <a href="#">Jewellery</a>,
                                    </div>
                                    <div class="blog-share-link">
                                        <h6>Share :</h6>
                                        <div class="blog-social-icon">
                                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                            <a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a>
                                            <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bài viết end -->
                        <!-- Hiển thị bình luận -->
                        <div class="comments-container">
                            {{-- Phần hiển thị bình luận --}}
                            <div class="comments-list">
                                <h3 class="comments-title">Bình luận</h3>
                                @if ($comments->isEmpty())
                                    <p class="no-comments">Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
                                @else
                                    @foreach ($comments as $comment)
                                        <div class="comment-item">
                                            <!-- Hình ảnh và thông tin người bình luận -->
                                            <div class="comment-avatar">
                                                <img src="{{ asset('asset-admin/img/profile.jpg') }}" alt="Avatar">
                                            </div>
                                            <div class="comment-content">
                                                <div class="comment-header">
                                                    <div class="comment-name-date">
                                                        <span class="comment-name">{{ $comment->name }}</span>
                                                        <span
                                                            class="comment-date">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                                                    </div>
                                                </div>
                                                <p class="comment-text">{{ $comment->content }}</p>
                                            </div>

                                            {{-- <!-- Hồi đáp -->
                                            <div class="reply-btn">
                                                <a href="javascript:void(0)"
                                                    onclick="toggleReplyForm(event, {{ $comment->id }})">Hồi đáp</a>
                                            </div>

                                            <!-- Form trả lời, ẩn ban đầu -->
                                            <div class="reply-form" id="reply-form-{{ $comment->id }}"
                                                style="display: none;">
                                                <form action="#" method="POST">
                                                    @csrf
                                                    <textarea name="content" placeholder="Trả lời bình luận của {{ $comment->name }}" required></textarea>
                                                    <button type="submit">Gửi trả lời</button>
                                                </form>
                                            </div> --}}
                                        </div>
                                    @endforeach
                                @endif
                            </div>



                            {{-- Phần form nhập bình luận --}}
                            <div class="comment-form-section">
                                <h4>Viết bình luận</h4>
                                <form action="{{ route('user.posts.comment', $post->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Tên của bạn:</label>
                                        <input type="text" name="name" id="name"
                                            placeholder="Tên của bạn" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email"
                                            placeholder="Email của bạn" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Bình luận:</label>
                                        <textarea name="content" id="content" placeholder="Nhập bình luận của bạn" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" class="btn-submit-comment">Gửi bình luận</button>
                                </form>
                            </div>
                        </div>


                        <!-- Bình luận -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog main wrapper end -->
</main>
@include('layouts.user.footer')
<script>
    function toggleReplyForm(event) {
        // Ngừng sự kiện mặc định (tránh reload trang)
        event.preventDefault();

        // Tìm bình luận chứa nút hồi đáp
        const commentItem = event.target.closest('.comment-item');

        // Tìm form trả lời trong bình luận này
        const replyForm = commentItem.querySelector('.reply-form');

        // Toggle hiển thị form trả lời
        replyForm.style.display = (replyForm.style.display === 'none' || replyForm.style.display === '') ? 'block' :
            'none';
    }

    function toggleReplyForm(event, commentId) {
        const form = document.getElementById(`reply-form-${commentId}`);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>
<style>
    .post-body p {
        text-indent: 2em;
        /* Căn đầu dòng 2 em */
        margin-bottom: 1.5em;
        /* Khoảng cách giữa các đoạn */
        line-height: 1.6;
        /* Dòng chữ cách nhau 1.6 lần chiều cao */
    }

    .post-body {
        font-size: 16px;
        color: #333;
    }

    /*  */
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

    /*  */
    /* Bố cục của comment */
    .comment-item {
        display: flex;
        flex-direction: row;
        /* Giữ các phần tử của bình luận (ảnh, tên, ngày) cùng hàng */
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ddd;
    }

    /* Ảnh đại diện */
    .comment-avatar {
        margin-right: 15px;
        /* Khoảng cách giữa ảnh và nội dung */
    }

    .comment-avatar img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Nội dung bình luận */
    .comment-content {
        display: flex;
        flex-direction: column;
        /* Nội dung được xếp theo chiều dọc (tên, ngày, và text) */
    }

    .comment-header {
        margin-bottom: 10px;
    }

    .comment-name-date {
        display: flex;
        flex-direction: column;
        /* Tên ở trên, ngày ở dưới */
    }

    .comment-name {
        font-weight: bold;
        color: #333;
    }

    .comment-date {
        font-size: 0.875rem;
        color: #777;
        margin-top: 5px;
    }

    .comment-text {
        font-size: 1rem;
        color: #333;
    }

    /* Hồi đáp */
    .reply-btn {
        font-size: 0.875rem;
        color: #007bff;
        cursor: pointer;
        margin-top: 10px;
    }

    /* Form trả lời */
    .reply-btn {
        margin-top: 10px;
    }

    .reply-form {
        display: none;
        margin-top: 10px;
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 5px;
    }

    .reply-form textarea {
        width: 100%;
        height: 60px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .reply-form button {
        margin-top: 10px;
        padding: 8px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .reply-form button:hover {
        background-color: #0056b3;
    }

    /*  */
    .comments-container {
        margin-top: 30px;
    }

    .comments-list {
        margin-bottom: 40px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .comments-title {
        font-size: 20px;
        margin-bottom: 20px;
        font-weight: bold;
        color: #333;
    }

    .no-comments {
        font-size: 16px;
        color: #666;
        text-align: center;
        margin: 10px 0;
    }

    .comment-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .comment-avatar img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 15px;
    }

    .comment-content {
        flex: 1;
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .comment-name {
        font-weight: bold;
        font-size: 16px;
        color: #333;
    }

    .comment-date {
        font-size: 12px;
        color: #999;
    }

    .comment-text {
        font-size: 14px;
        color: #555;
        line-height: 1.6;
    }

    .comment-form-section {
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
    }

    .comment-form-section h4 {
        font-size: 18px;
        margin-bottom: 15px;
        font-weight: bold;
        color: #333;
    }

    .comment-form-section .form-group {
        margin-bottom: 15px;
    }

    .comment-form-section label {
        display: block;
        font-size: 14px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .comment-form-section input,
    .comment-form-section textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        color: #555;
    }

    .comment-form-section textarea {
        resize: none;
    }

    .btn-submit-comment {
        padding: 10px 15px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        display: inline-block;
    }

    .btn-submit-comment:hover {
        background-color: #0056b3;
    }
</style>
