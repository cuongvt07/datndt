@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <h1>Sửa bài viết</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $post->title) }}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh hoặc Video</label>
                <input type="file" class="form-control" id="image" name="image">
                <input type="text" class="form-control mt-2" id="video" name="video"
                    placeholder="Hoặc nhập URL video YouTube (Nếu có)" value="{{ old('video', $post->video) }}">

                {{-- Hiển thị ảnh nếu tồn tại --}}
                @if ($post->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Hình ảnh bài viết" width="100">
                        <div>
                            <input type="checkbox" id="delete_image" name="delete_image" value="1">
                            <label for="delete_image">Xóa ảnh hiện tại</label>
                        </div>
                    </div>
                @endif

                {{-- Hiển thị video nếu tồn tại --}}
                @if ($post->video)
                    <div class="mt-2">
                        <iframe width="300" height="200"
                            src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($post->video, 'v=') }}"
                            frameborder="0" allowfullscreen></iframe>
                        <div>
                            <input type="checkbox" id="delete_video" name="delete_video" value="1">
                            <label for="delete_video">Xóa video hiện tại</label>
                        </div>
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea id="editor" class="form-control" id="content" name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
            </div>
            <div>
                <label class="form-label" for="category_id">Danh mục</label>
                <select class="form-control" name="category_id" required>
                    <option value="">Chọn một danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
        </form>
    </div>
@endsection
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cấu hình CKEditor
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
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

        // Lấy các phần tử liên quan
        const deleteVideoCheckbox = document.getElementById('delete_video');
        const videoInput = document.getElementById('video');
        const videoPreview = document.getElementById('videoPreview');

        // Xử lý khi chọn "Xóa video hiện tại"
        if (deleteVideoCheckbox && videoInput) {
            deleteVideoCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    videoInput.value = ''; // Xóa giá trị trong input
                    if (videoPreview) videoPreview.innerHTML = ''; // Xóa preview video
                }
            });
        }

        // Hiển thị preview video YouTube khi nhập URL
        if (videoInput && videoPreview) {
            videoInput.addEventListener('input', function() {
                const videoUrl = this.value;
                const videoId = videoUrl.match(
                    /(?:youtube\.com\/(?:[^\/]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/
                    );

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
