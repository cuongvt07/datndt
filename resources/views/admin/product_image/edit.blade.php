@extends('layouts.admin.master')

@section('content')

<form action="{{ route('product_image.update', $image->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label class="form-label" for="product_id">Sản phẩm:</label>
    <select class="form-control" name="product_id" id="product_id" required>
        <option value="">Chọn sản phẩm</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}" {{ $product->id == $image->product_id ? 'selected' : '' }}>{{ $product->name_sp }}</option>
        @endforeach
    </select>

    <label class="form-label" for="colour_id">Màu sắc:</label>
    <select class="form-control" name="colour_id" id="colour_id" required>
        <option value="">Chọn màu</option>
        <!-- Các màu hiện tại của sản phẩm đã được chọn -->
        @foreach($colours as $colour)
            <option value="{{ $colour->id }}" {{ $colour->id == $image->colour_id ? 'selected' : '' }}>{{ $colour->name }}</option>
        @endforeach
    </select>

    <label class="form-label" for="image">Hình ảnh:</label>
    <input class="form-control" type="file" name="image">

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

<script>
    // Khi thay đổi sản phẩm, tải màu sắc động
    document.getElementById('product_id').addEventListener('change', function() {
        let productId = this.value;
        let colourSelect = document.getElementById('colour_id');

        // Xóa danh sách màu hiện tại
        colourSelect.innerHTML = '<option value="">Chọn màu</option>';

        if (productId) {
            fetch(`/admin/products/${productId}/colours`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(function(colour) {
                        let option = document.createElement('option');
                        option.value = colour.id;
                        option.text = colour.name;
                        colourSelect.appendChild(option);
                    });

                    // Nếu sản phẩm đang sửa có màu, chọn màu đó
                    let currentColourId = '{{ $image->colour_id }}';
                    if (currentColourId) {
                        colourSelect.value = currentColourId;
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });

    // Kích hoạt sự kiện 'change' khi tải trang để hiển thị màu hiện tại
    document.getElementById('product_id').dispatchEvent(new Event('change'));
</script>

@endsection
