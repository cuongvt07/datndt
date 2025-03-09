
@extends('layouts.admin.master')

@section('content')
<h1>Quản lý đánh giá</h1>
<br>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
      @foreach ($reviews as $review)
      <tr>
          <td>{{  $review->user->name_user }}</td>
          <td>{{ $review->email }}</td>
          <td>
            <div class="review-rating">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>                @endfor
            </div>
        </td>         
          <td>{{ $review->content}}</td>
          <td> {{ \Carbon\Carbon::parse($review->created_at)->format('Y-m-d H:i') }}</td>
          <td>
            <form action="{{ route('review.destroy', $review->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" 
                    onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')">Xóa</button>
            </form>
        </td>
        
      </tr>
      @endforeach
    </tbody>
</table>
@endsection
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