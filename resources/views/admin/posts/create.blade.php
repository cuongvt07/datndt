@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <h1>Thêm bài viết mới</h1>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" >
                @error('title')
      <div class="text-danger">{{ $message }}</div>
  @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh hoặc Video</label>
                <input type="file" class="form-control" id="image" name="image">
                <input type="text" class="form-control mt-2" id="video" name="video" placeholder="Hoặc nhập URL video YouTube (Nếu có)">
                <div id="videoPreview" class="mt-2"></div>
                @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>                      
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea id="editor" class="form-control" name="content" rows="10" cols="80">
                    {{ old('content', $post->content ?? '') }}</textarea>
                    @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="category_id">Danh mục</label>
                <select class="form-control" name="category_id" >
                    <option value="">Chọn danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            <button type="submit" class="btn btn-primary">Thêm bài viết</button>
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
