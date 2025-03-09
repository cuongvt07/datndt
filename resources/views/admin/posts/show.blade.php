@extends('layouts.admin.master')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>

        @if($post->image)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $post->image) }}" alt="Image" class="img-fluid">
            </div>
        @endif

        @if($post->video)
            <div class="mb-3">
                <iframe width="560" height="315" src="{{ $post->video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        @endif

        <div class="mb-3">
            <h4>Nội dung bài viết</h4>
            <p>{!! $post->content !!}</p>
        </div>

        <div class="mb-3">
            <h5>Danh mục</h5>
            <p>{{ $post->category->name ?? 'Chưa có danh mục' }}</p>
        </div>

        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Quay lại danh sách bài viết</a>
    </div>
@endsection
