@extends('layouts.admin.master')

@section('content')

<form action="{{ route('product_image.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label class="form-label" for="filter_product">Tìm kiếm sản phẩm:</label>
        <input type="text" class="form-control" id="filter_product" placeholder="Nhập tên sản phẩm để tìm...">
    </div>

    <div class="form-group">
        <label class="form-label" for="product_id">Sản phẩm:</label>
        <select class="form-control" name="product_id" id="product_id" >
            <option value="">Chọn sản phẩm</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name_sp }}</option>
            @endforeach
        </select>
        @error('product_id')
      <div class="text-danger">{{ $message }}</div>
  @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="colour_id">Màu sắc:</label>
        <select class="form-control" name="colour_id" id="colour_id" >
            <option value="">Chọn màu</option>
        </select>
        @error('colour_id')
      <div class="text-danger">{{ $message }}</div>
  @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="image">Hình ảnh:</label>
        <input class="form-control" type="file" name="image" >
        @error('image')
      <div class="text-danger">{{ $message }}</div>
  @enderror
    </div>
    <button style="margin-top: 20px" type="submit" class="btn btn-primary">Tải lên</button>
</form>

<script>
    // Lọc sản phẩm trong danh sách
    document.getElementById('filter_product').addEventListener('input', function() {
        const filterValue = this.value.toLowerCase();
        const productSelect = document.getElementById('product_id');
        const options = productSelect.options;

        for (let i = 1; i < options.length; i++) { // Bắt đầu từ 1 để bỏ qua "Chọn sản phẩm"
            const productName = options[i].text.toLowerCase();
            options[i].style.display = productName.includes(filterValue) ? 'block' : 'none';
        }
    });

    // Load màu sắc khi chọn sản phẩm
    document.getElementById('product_id').addEventListener('change', function() {
        let productId = this.value;
        let colourSelect = document.getElementById('colour_id');

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
                })
                .catch(error => console.error('Error:', error));
        }
    });

        // Lọc sản phẩm trong danh sách
        document.getElementById('filter_product').addEventListener('input', function() {
        const filterValue = this.value.toLowerCase();
        const productSelect = document.getElementById('product_id');
        const options = productSelect.options;

        let hasVisibleOptions = false;

        for (let i = 1; i < options.length; i++) { // Bỏ qua "Chọn sản phẩm"
            const productName = options[i].text.toLowerCase();
            options[i].style.display = productName.includes(filterValue) ? 'block' : 'none';
            if (options[i].style.display === 'block') {
                hasVisibleOptions = true;
            }
        }

        // Mở dropdown nếu có tùy chọn hiển thị
        if (hasVisibleOptions) {
            productSelect.size = Math.min(5, options.length - 1); // Thay đổi kích thước để hiển thị tối đa 5 tùy chọn
        } else {
            productSelect.size = 1; // Đặt lại về 1 nếu không có tùy chọn
        }
    });

    // Đặt lại dropdown khi chọn sản phẩm
    document.getElementById('product_id').addEventListener('change', function() {
        document.getElementById('filter_product').value = this.options[this.selectedIndex].text; // Cập nhật input với tên sản phẩm đã chọn
        this.size = 1; // Đặt lại kích thước
    });

    // Đặt lại dropdown khi bỏ chọn input
    document.getElementById('filter_product').addEventListener('blur', function() {
        if (!this.value) { // Nếu không có giá trị
            const productSelect = document.getElementById('product_id');
            productSelect.size = 1; // Đặt lại kích thước
            for (let i = 1; i < productSelect.options.length; i++) {
                productSelect.options[i].style.display = 'block'; // Hiển thị tất cả tùy chọn
            }
        }
    });
</script>

@endsection
