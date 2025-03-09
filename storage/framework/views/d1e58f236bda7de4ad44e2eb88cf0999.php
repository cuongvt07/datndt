<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Thêm Liên Kết Sản Phẩm - Biến Thể</h1>
    
    <form action="<?php echo e(route('product_variants.create')); ?>" method="GET">
       
        <div class="mb-3">
            <label for="name_sp" class="form-label">Tìm Kiếm Sản Phẩm</label>
            <input type="text" name="name_sp" id="name_sp" class="form-control" value="<?php echo e(request('name_sp')); ?>" placeholder="Tên sản phẩm">
        </div>
        <button type="submit" class="btn btn-secondary">Lọc</button>
    </form>
    
    <form action="<?php echo e(route('product_variants.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="product_id" class="form-label">Sản Phẩm</label>
            <select name="product_id" id="product_id" class="form-control">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->id); ?>"><?php echo e($product->name_sp); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <div class="text-danger"><?php echo e($message); ?></div>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="mb-3">
            <label for="variant_id" class="form-label">Biến Thể</label>
            <select name="variant_id" id="variant_id" class="form-control">
                <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($variant->id); ?>"><?php echo e($variant->ram_smartphone); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['variant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <div class="text-danger"><?php echo e($message); ?></div>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<script>
    public function create(Request $request)
{
    $query = Product::query();

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('name_sp')) {
        $query->where('name_sp', 'like', '%' . $request->name_sp . '%');
    }

    $products = $query->get();

    $variants = Variant::all(); 

    return view('admin.product_variants.create', compact('products', 'categories', 'variants'));
}

</script>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\datn\resources\views/admin/product_variants/create.blade.php ENDPATH**/ ?>