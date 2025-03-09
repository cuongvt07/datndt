@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <h1>Danh sách bài viết</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Thêm bài viết mới</a>

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
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            @if ($post->video)
                                <!-- Nếu có video, hiển thị video -->
                                <div class="video-container">
                                    <!-- Đảm bảo rằng video có ID đúng và URL YouTube được cấu hình đúng -->
                                    <iframe width="80px" height="80px"
                                        src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($post->video, 'v=') }}"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                            @elseif ($post->image)
                                <!-- Nếu không có video, hiển thị ảnh -->
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" width="80px"
                                    height="80px">
                            @else
                                Không có ảnh hoặc video
                            @endif
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>
                            {!! \Illuminate\Support\Str::limit(strip_tags($post->content, '<p><a><strong><em><ul><li><ol>'), 50, '...') !!}
                        </td>                                                
                        <td>{{ $post->created_at->format('d/m/Y') }}</td>
                        <td>{{ $post->category ? $post->category->name : 'Không có danh mục' }}</td>
                        <td>
                            <!-- Nút Sửa -->
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Sửa</a>

                            <!-- Form Xóa -->
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">Xóa</button>
                            </form>
                            <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="btn btn-info">Xem</a>

                            <!-- Có thể thêm các nút sửa và xóa ở đây -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
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
                uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
