@extends('layouts.admin.master')

@section('content')
    <h1 class="mb-4">Chọn khách hàng để gửi mã giảm giá</h1>

    <!-- Form tìm kiếm -->
    <form class="mb-4">
        <div class="input-group">
            <input type="text" id="search" name="search" class="form-control" placeholder="Tìm theo tên hoặc email..."
                value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </div>
    </form>

    <!-- Danh sách khách hàng -->
    <form action="{{ route('admin.discount_codes.sendToSelectedUsers') }}" method="POST">
        @csrf
        <input type="hidden" name="discount_code_id" value="{{ $discountCode->id }}">

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Chọn</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody id="user-list">
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_users[]" value="{{ $user->id }}">
                            </td>
                            <td>{{ $user->name_user }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Không tìm thấy khách hàng</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-success">Gửi mã giảm giá</button>
    </form>

    <script>
        $(document).ready(function() {
            // Lắng nghe sự kiện khi người dùng nhập vào ô tìm kiếm
            $('#search').on('input', function() {
                var query = $(this).val(); // Lấy giá trị tìm kiếm

                // Gửi yêu cầu AJAX
                $.ajax({
                    url: '{{ route('admin.discount_codes.selectUsers', $discountCode->id) }}', // URL của route
                    type: 'GET',
                    data: {
                        search: query // Gửi từ khóa tìm kiếm
                    },
                    success: function(response) {
                        // Cập nhật lại danh sách khách hàng
                        $('#user-list').html(response);
                    }
                });
            });
        });
    </script>
@endsection
