
<table style="margin-top: 20px" class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Biến thể</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>
                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseColors{{ $product->id }}" aria-expanded="false"
                        aria-controls="collapseColors{{ $product->id }}">
                        <i class="bi bi-plus-circle"></i>
                    </button>
                </td>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name_sp }}</td>
                <td>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name_sp }}"
                            width="50" height="50">
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    {{ $product->variant ? $product->variant->ram_smartphone : 'Không có' }}<br>
                    {{ $product->battery ? $product->battery->capacity : 'Không có' }}<br>
                    {{ $product->screen ? $product->screen->name : 'Không có' }}
                </td>
                <td>{{ number_format($product->price, 0, ',', '.') }}₫</td>
                <td>{{ $product->stock }}</td>
                <td>
                    @if ($product->stock >= 5)
                        <span style="color: green; font-weight: bold;">Còn hàng</span>
                    @elseif($product->stock > 0 && $product->stock < 5)
                        <span style="color: orange; font-weight: bold;">Sắp hết hàng</span>
                    @else
                        <span style="color: red; font-weight: bold;">Hết hàng</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 5px;">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning" style="height: 40px;">Sửa</a>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary" style="height: 40px;">Xem</a>
                        <form action="{{ route('products.toggle', $product) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            <button type="submit"
                                class="btn {{ $product->is_active ? 'btn-danger' : 'btn-success' }}">
                                {{ $product->is_active ? 'Ẩn' : 'Hiện' }}
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
            <tr>
                <td colspan="9" class="p-0">
                    <div id="collapseColors{{ $product->id }}" class="collapse">
                        <div class="card card-body">
                            <h5>Màu sắc có sẵn cho {{ $product->name_sp }} <button style="float: right"
                                    class="btn btn-primary"><a
                                        href="{{ route('colours.index') }}">Thêm</a></button></h5>

                            @if ($product->colours->isEmpty())
                                <p>Không có màu nào có sẵn cho sản phẩm này.</p>
                            @else
                                <!-- Table to display color details -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên màu sắc</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->colours as $colour)
                                            <tr>
                                                <td>{{ $colour->id }}</td>
                                                <td>{{ $colour->name }}</td>
                                                <td>{{ $colour->price }}</td>
                                                <td>{{ $colour->quantity }}</td>
                                                <td>
                                                    @if ($colour->quantity >= 5)
                                                        <span style="color: green; font-weight: bold;">Còn
                                                            hàng</span>
                                                    @elseif($colour->quantity > 0 && $colour->quantity < 5)
                                                        <span style="color: orange; font-weight: bold;">Sắp
                                                            hết hàng</span>
                                                    @else
                                                        <span style="color: red; font-weight: bold;">Hết
                                                            hàng</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    document.getElementById('search-form').addEventListener('submit', function(event) {
        event.preventDefault();

        let keyword = document.getElementById('keyword').value;
        let url = "{{ route('products.index') }}";

        fetch(url + '?keyword=' + keyword, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' 
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('product-list').innerHTML = data.html; 
            })
            .catch(error => console.error('Error:', error));
    });
</script>