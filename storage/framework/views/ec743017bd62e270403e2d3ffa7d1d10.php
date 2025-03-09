<?php echo $__env->make('layouts.user.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('layouts.user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<head>
    <meta http-equiv="Cache-Control" content="no-store" />
</head>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">Cửa hàng</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <?php if($cart && $cart->cartItems->count() > 0): ?>
                        <div class="col-lg-12">

                            <div class="cart-table table-responsive">
                                <?php
                                    $hasVariant = false;
                                    foreach ($cart->cartItems as $item) {
                                        if ($item->variant) {
                                            $hasVariant = true;
                                            break;
                                        }
                                    }
                                ?>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all" onclick="toggleSelectAll(this)">
                                            </th>
                                            <th class="pro-thumbnail">Ảnh sản phẩm</th>
                                            <th class="pro-title">Sản phẩm</th>
                                            <th class="pro-color">Màu sắc</th>
                                            <th class="pro-battery">Pin</th>

                                            <th class="pro-ram">Ram</th>

                                            <th class="pro-price">Giá</th>
                                            <th class="pro-quantity">Số lượng</th>
                                            <th class="pro-subtotal">Tổng cộng</th>
                                            <th class="pro-remove">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $cart->cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $productPrice = $item->product->price ?? 0;
                                            $variantPrice = $item->variant->price ?? 0;
                                            // $batteryPrice = $item->battery->price ?? 0;
                                            $colorPrice = $item->color->price ?? 0;
                                            
                                            $totalPricePerItem = $productPrice + $variantPrice + $colorPrice;
                                            $totalPrice = $totalPricePerItem * $item->quantity;
                                            $isOutOfStock = $item->color->quantity <= 0;
                                            ?>
                                            <tr style="<?php echo e($isOutOfStock ? 'opacity: 0.5;' : ''); ?>">
                                                <td>
                                                    <input type="checkbox" class="product-checkbox"
                                                        onclick="updateGrandTotal()" data-id="<?php echo e($item->id); ?>"
                                                        <?php echo e($isOutOfStock ? 'disabled' : ''); ?>>
                                                </td>
                                                <td class="pro-thumbnail">
                                                    <a href="#">
                                                        <img class="img-fluid"
                                                            src="<?php echo e(asset('storage/' . $item->product->productImages->where('colour_id', $item->color_id)->first()->image_path)); ?>"
                                                            alt="Product" />
                                                    </a>
                                                </td>
                                                <td class="pro-title">
                                                    <a href="#"><?php echo e($item->product->name_sp); ?></a>
                                                </td>
                                                <td class="pro-color"><?php echo e($item->color->name ?? 'Không có màu'); ?></td>
                                                <td><?php echo e($item->product->battery->capacity); ?></td>

                                                <td class="pro-ram"><?php echo e($item->variant->ram_smartphone ?? 'Không có'); ?>

                                                </td>
                                                <td class="pro-price" data-price="<?php echo e($totalPricePerItem); ?>">
                                                    <?php echo e(number_format($totalPricePerItem, 0, ',', '.')); ?> ₫
                                                </td>
                                                <td id="cart-item-<?php echo e($item->id); ?>">
                                                    <?php if(!$isOutOfStock): ?>
                                                        <button class="btn btn-secondary btn-sm"
                                                            onclick="updateQuantity(<?php echo e($item->id); ?>, -1)"
                                                            style="font-size: 0.8em; padding: 0.2rem 0.5rem;">-</button>
                                                        <span
                                                            id="quantity-<?php echo e($item->id); ?>"><?php echo e($item->quantity); ?></span>
                                                        <button class="btn btn-secondary btn-sm"
                                                            onclick="updateQuantity(<?php echo e($item->id); ?>, 1)"
                                                            style="font-size: 0.8em; padding: 0.2rem 0.5rem;">+</button>
                                                    <?php else: ?>
                                                        <span>Đã hết hàng</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td id="total-<?php echo e($item->id); ?>"
                                                    data-quantity="<?php echo e($item->quantity); ?>">
                                                    <?php echo e(number_format($totalPrice, 0, ',', '.')); ?> ₫
                                                </td>
                                                <td class="pro-remove">
                                                    <a href="#"
                                                        onclick="confirmRemoveFromCart(<?php echo e($item->id); ?>)"><i
                                                            class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>

                                </table>

                            </div>
                            <!-- Cart Update Option -->
                            <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <div class="apply-coupon-wrapper">
                                    <form id="discount-form" action="<?php echo e(route('cart.applyDiscount')); ?>" method="POST"
                                        class="d-block d-md-flex" onsubmit="applyDiscountCode(event);">
                                        <?php echo csrf_field(); ?>
                                        <input type="text" name="discount_code" placeholder="Nhập mã phiếu giảm giá"
                                            required />
                                        <input type="hidden" name="selected_items" id="selected-items"
                                            value="" />
                                        <button type="submit" class="btn btn-sqr">Áp dụng phiếu giảm giá</button>
                                    </form>

                                </div>
                                <div class="cart-update">
                                    <button class=""
                                        style="background-color: red;color:floralwhite;width:158px;height:38px"
                                        class="btn btn-danger" onclick="confirmRemoveAllFromCart()">Xóa tất cả sản
                                        phẩm</button>
                                </div>
                                <div class="cart-page-total">
                                    <ul>
                                        <li>Tổng cộng <span
                                                id="grand-total"><?php echo e(number_format(
                                                    $cart->cartItems->sum(function ($item) {
                                                        $productPrice = $item->product->price ?? 0;
                                                        $variantPrice = $item->variant->price ?? 0;
                                                        // $batteryPrice = $item->battery->price ?? 0;
                                                        $colorPrice = $item->color->price ?? 0;
                                                        return ($productPrice + $variantPrice + $colorPrice) * $item->quantity;
                                                    }),
                                                    0,
                                                    ',',
                                                    '.',
                                                )); ?>

                                                ₫</span></li>

                                        <li id="discount-li"
                                            style="display: <?php echo e(session()->has('discount_code') && session('total_after_discount') > 0 ? 'list-item' : 'none'); ?>">
                                            Số tiền giảm giá
                                            <span
                                                id="discount-amount"><?php echo e(number_format(session('discount_amount', 0), 0, ',', '.')); ?>

                                                ₫</span>
                                        </li>

                                        <li id="total-after-discount-li"
                                            style="display: <?php echo e(session()->has('discount_code') && session('total_after_discount') > 0 ? 'list-item' : 'none'); ?>">
                                            Tổng tiền sau giảm giá
                                            <span
                                                id="total-after-discount"><?php echo e(number_format(session('total_after_discount', 0), 0, ',', '.')); ?>

                                                ₫</span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="col-md-9">
                                    <a href="<?php echo e(route('shop')); ?>" class="btn btn-sqr">Thêm sản phẩm</a>
                                </div>
                                <div class="col-md-3">
                                    <div class="cart-update">
                                        <a href="<?php echo e(route('checkout')); ?>" id="checkout-button"
                                            class="btn btn-sqr">Cập
                                            nhật giỏ hàng thanh
                                            toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <p>Giỏ hàng của bạn hiện đang trống.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    function updateQuantity(itemId, change) {
        const quantityElement = document.getElementById(`quantity-${itemId}`);
        let quantity = parseInt(quantityElement.innerText) + change;

        if (quantity < 1) {
            quantity = 1; // Đảm bảo số lượng tối thiểu là 1
        }

        $.ajax({
            url: '/cart/update-quantity',
            type: 'POST',
            data: {
                item_id: itemId,
                quantity: quantity,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (response.success) {
                    location.reload(); // Tải lại trang nếu cập nhật thành công
                } else if (response.max_quantity === 0) {
                    // Nếu hết hàng, hiển thị "Đã hết hàng"
                    alert(response.message);
                    quantityElement.innerText = "Đã hết hàng";
                    quantityElement.classList.add("text-danger"); // Thêm class CSS cho nổi bật
                    document.getElementById(`increase-${itemId}`).disabled = true; // Tắt nút tăng
                    document.getElementById(`decrease-${itemId}`).disabled = true; // Tắt nút giảm
                } else if (response.max_quantity !== undefined) {
                    // Hiển thị thông báo khi số lượng vượt quá tồn kho
                    alert(response.message);
                    quantityElement.innerText = response.max_quantity; // Cập nhật về số lượng tối đa
                }
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    }
</script>
<script>
    window.addEventListener("pageshow", function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    document.querySelector('#checkout-button').addEventListener('click', function(e) {
        e.preventDefault();

        const selectedItems = [];
        document.querySelectorAll('.product-checkbox:checked').forEach(function(checkbox) {
            selectedItems.push(checkbox.getAttribute('data-id'));
        });

        if (selectedItems.length === 0) {
            alert('Vui lòng chọn ít nhất một sản phẩm để thanh toán.');
            return;
        }

        // Gửi yêu cầu kiểm tra số lượng
        $.ajax({
            url: "<?php echo e(route('cart.checkStock')); ?>", // Tạo route kiểm tra số lượng
            type: 'POST',
            data: {
                selected_items: selectedItems,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (response.success) {
                    // Nếu số lượng hợp lệ, chuyển đến route thanh toán
                    $.ajax({
                        url: "<?php echo e(route('cart.selectItems')); ?>",
                        type: 'POST',
                        data: {
                            selected_items: selectedItems,
                            _token: '<?php echo e(csrf_token()); ?>'
                        },
                        success: function(selectResponse) {
                            if (selectResponse.success) {
                                window.location.href = "<?php echo e(route('checkout')); ?>";
                            } else {
                                alert(selectResponse.message);
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr);
                        }
                    });
                } else {
                    // Hiển thị thông báo nếu sản phẩm không đủ số lượng
                    alert(response.message);
                }
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });
</script>
<script>
    function applyDiscountCode(event) {
        event.preventDefault(); // Ngăn chặn việc tải lại trang

        const selectedItems = [];
        document.querySelectorAll('.product-checkbox:checked').forEach(function(checkbox) {
            selectedItems.push(checkbox.getAttribute('data-id'));
        });

        $.ajax({
            url: $('#discount-form').attr('action'), // Lấy URL từ action của form
            type: 'POST',
            data: {
                discount_code: document.querySelector('input[name="discount_code"]').value,
                selected_items: selectedItems,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Thành công!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });

                    // Cập nhật lại giá trị tổng tiền và giảm giá hiển thị trên trang
                    $('#grand-total').text(numberWithCommas(Math.round(response.total_price)) + ' ₫');
                    $('#discount-amount').text(numberWithCommas(Math.round(response.discount_amount)) +
                        ' ₫');
                    $('#total-after-discount').text(numberWithCommas(Math.round(response
                        .total_after_discount)) + ' ₫');

                    // Hiển thị phần tử giảm giá nếu có
                    if (response.discount_amount > 0) {
                        $('#discount-li').show();
                        $('#total-after-discount-li').show();
                    } else {
                        $('#discount-li').hide();
                        $('#total-after-discount-li').hide();
                    }

                } else {
                    Swal.fire({
                        title: 'Lỗi!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr) {
                console.error(xhr);
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Đã xảy ra lỗi khi áp dụng mã giảm giá!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    }


    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }




    function updateGrandTotal() {
        let grandTotal = 0;

        // Duyệt qua các checkbox đã chọn
        document.querySelectorAll('.product-checkbox:checked').forEach(function(checkbox) {
            const priceElement = checkbox.closest('tr').querySelector('.pro-price');
            const totalPricePerItem = parseFloat(priceElement.getAttribute('data-price'));
            const quantity = parseInt(checkbox.closest('tr').querySelector(`[data-quantity]`).getAttribute(
                'data-quantity'));

            grandTotal += totalPricePerItem * quantity;
        });

        // Cập nhật tổng tiền vào giao diện
        document.getElementById('grand-total').innerText = numberWithCommas(grandTotal) + ' ₫';

        // Reset discount and total when products are selected/deselected
        resetDiscountAndTotal();
    }

    // Reset discount and total values when the cart is modified
    function resetDiscountAndTotal() {
        document.getElementById('discount-li').style.display = 'none';
        document.getElementById('total-after-discount-li').style.display = 'none';
        document.getElementById('discount-amount').innerText = '0 ₫';
        document.getElementById('total-after-discount').innerText = '0 ₫';
        document.getElementById('selected-items').value = '';
    }


    // Hàm định dạng số
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Đảm bảo gọi updateGrandTotal khi trang tải
    document.addEventListener('DOMContentLoaded', function() {
        updateGrandTotal(); // Tính tổng tiền khi trang tải
    });



    function toggleSelectAll(selectAllCheckbox) {
        const checkboxes = document.querySelectorAll('.product-checkbox');

        checkboxes.forEach((checkbox) => {
            if (!checkbox.disabled) { // Chỉ thay đổi trạng thái của các checkbox không bị disabled
                checkbox.checked = selectAllCheckbox.checked;
            }
        });

        updateGrandTotal();
    }


    function confirmRemoveFromCart(itemId) {
        Swal.fire({
            title: "Bạn có chắc không?",
            text: "Bạn sẽ không thể hoàn tác điều này!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Có, xóa nó!",
            cancelButtonText: "Hủy"
        }).then((result) => {
            if (result.isConfirmed) {
                removeFromCart(itemId).then(() => {
                    Swal.fire({
                        title: "Xóa!",
                        text: "Bạn đã xóa sản phẩm này!",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        location.reload();
                    });
                });
            }
        });
    }

    function removeFromCart(itemId) {
        return $.ajax({
            url: '/cart/remove',
            type: 'POST',
            data: {
                item_id: itemId,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }



    function confirmRemoveAllFromCart() {
        Swal.fire({
            title: "Bạn có chắc không?",
            text: "Bạn sẽ không thể hoàn tác điều này!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Có, xóa tất cả!",
            cancelButtonText: "Hủy"
        }).then((result) => {
            if (result.isConfirmed) {
                removeAllFromCart().then(() => {
                    Swal.fire({
                        title: "Đã xóa!",
                        text: "Tất cả sản phẩm đã được xóa khỏi giỏ hàng!",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        location.reload();
                    });
                });
            }
        });
    }

    function removeAllFromCart() {
        return $.ajax({
            url: '/cart/remove-all',
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    }
</script>
<style>
    .text-danger {
        color: red;
        font-weight: bold;
    }
</style>


<?php echo $__env->make('layouts.user.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\ProjectDT\datn\datn\resources\views/user/Cart.blade.php ENDPATH**/ ?>