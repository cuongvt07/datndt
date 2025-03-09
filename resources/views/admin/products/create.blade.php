@extends('layouts.admin.master')

@section('content')
    <h1 style="margin-top: 60px;">Thêm sản phẩm</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="card shadow-lg" style="width: 1230px;">
                        <div class="card-header bg-primary text-white">
                            <p class="mb-0">Tạo Đơn Hàng</p>
                        </div>
                        <div class="card-body">
                            <div class="form-group  mb-3">
                                <label for="name_sp">Tên sản phẩm</label>
                                <input type="text" name="name_sp" class="form-control"  value="{{ old('name_sp') }}">
                                @error('name_sp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="form-group  mb-3">
                                <label for="image">Hình ảnh</label>
                                <input type="file" name="image" class="form-control" >
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="form-group  mb-3" >
                                <label for="price">Giá</label>
                                <input type="number" name="price" class="form-control"  value="{{ old('price') }}">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="form-group  mb-3">
                                <label for="description">Mô tả</label>
                                <input type="text" name="description" class="form-control"  value="{{ old('description') }}">
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    
                    
                            <div class="form-group  mb-3">
                                <label class="form-label" for="category_id">Danh mục</label>
                                <select class="form-control" name="category_id" >
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group  mb-3">
                                <label class="form-label" for="supplier_id">Nhà cung cấp</label>
                            
                              
                                <input type="text" id="supplierFilter" class="form-control mb-2" placeholder="Tìm kiếm nhà cung cấp...">
                            
                               
                                <select class="form-control" name="supplier_id" id="supplierDropdown">
                                    <option value="">Chọn nhà cung cấp</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->brand }}</option>
                                    @endforeach
                                </select>
                            
                                @error('supplier_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                                <div class="col">
                                    <label class="form-label" for="battery">Pin</label>
                                    <select class="form-control" name="battery_id">
                                        <option value="">Chọn pin</option>
                                        @foreach ($batterys as $battery)
                                            <option value="{{ $battery->id }}">{{ $battery->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <label class="form-label" for="screen_id">Màn hình</label>
                                    <select class="form-control" name="screen_id">
                                        <option value="">Chọn màn hình</option>
                                        @foreach ($screens as $screen)
                                            <option value="{{ $screen->id }}">{{ $screen->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    
                            <button style="margin-top: 20px" type="submit" class="btn btn-success w-100">Lưu</button>
    
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </form>
  
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const colourFilter = document.getElementById("colourFilter");
        const colourDropdown = document.getElementById("colourDropdown");

        colourFilter.addEventListener("input", function () {
            const filterText = colourFilter.value.toLowerCase();
            const options = colourDropdown.querySelectorAll("option");

            options.forEach(option => {
                if (option.textContent.toLowerCase().includes(filterText) || option.value === "") {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const supplierFilter = document.getElementById("supplierFilter");
        const supplierDropdown = document.getElementById("supplierDropdown");

        supplierFilter.addEventListener("input", function () {
            const filterText = supplierFilter.value.toLowerCase();
            const options = supplierDropdown.querySelectorAll("option");

            options.forEach(option => {
                if (option.textContent.toLowerCase().includes(filterText) || option.value === "") {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            });
        });
    });
</script>

