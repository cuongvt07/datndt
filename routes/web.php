<?php

use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\ReviewAdminController;
use App\Http\Controllers\PostClientController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\user\WishlistController;
use Illuminate\Support\Facades\Route;
// Admin
use App\Http\Controllers\admin\BatteryController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ColourController;
use App\Http\Controllers\admin\OrderManagementController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\ScreenController;
use App\Http\Controllers\admin\SupplierController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\VariantController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\AnnalistController;
//User
use App\Http\Controllers\User\account\AccountController;
use App\Http\Controllers\User\profile\ProfileController;

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductUserController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;

// Auth
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\admin\ProductVariantController;



use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\Admin\AdminChatController;



/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

// Route::get('/', function () {
//     return view('index');   //trang chủ user
// })->name('index');

Route::get('/', [HomeController::class, 'index'])->name('index'); // Trang chủ user
// Route::get('/', function () {
//     return view('user.index');   // Trang chủ user
// })->name('index');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('member', [MemberController::class, 'dashboard'])
    ->name('user.index')
    ->middleware(['auth']);
// Cửa hàng
Route::get(uri: '/shop', action: [ProductUserController::class, 'index'])->name('shop');

Route::get('/product/{id}', [ProductUserController::class, 'show'])->name('product.show');

//Giới thiệu
Route::get('/about', function () {
    return view('user.about');
})->name('about');

//Liên hệ
Route::get('/contact', function () {
    return view('user.contact');
})->name('contact');

// Account
Route::get(uri: '/account', action: [AccountController::class, 'index'])->name('account');
// Thay đổi mật khẩu
Route::post('password/change', [AccountController::class, 'changePassword'])->name('password.change');
Route::post('account/update', [AccountController::class, 'update'])->name('account.update');

//Profile
Route::get(uri: '/profile', action: [ProfileController::class, 'index'])->name('profile');

// Reviews
Route::post('products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
Route::post('/orders/review', [OrderController::class, 'store'])->name('orders.store');
Route::post('/orders/{order}/review', [OrderController::class, 'store'])->name('orders.store');
Route::get('product/{product}', [OrderController::class, 'show'])->name('product.show');

Route::post('/orders/{order}/review', [OrderController::class, 'store'])->name('orders.store');
Route::get('product/{product}', [OrderController::class, 'show'])->name('product.show');

// Bài viết
Route::get('/posts', [PostClientController::class, 'index'])->name('post');
Route::get('/posts/{post}', [PostClientController::class, 'show'])->name('user.posts.show');
// Bình luận bài viết 
Route::get('posts/{id}', [PostClientController::class, 'show'])->name('user.posts.show');
Route::post('posts/{id}/comment', action: [PostClientController::class, 'storeComment'])->name('user.posts.comment');

// Route lọc bài viết theo danh mục
Route::get('posts/category/{category}', [PostClientController::class, 'filterByCategory'])->name('user.posts.category');

// Route lọc bài viết theo tháng và năm
Route::get('posts/archive/{year}/{month}', [PostClientController::class, 'filterByArchive'])->name('user.posts.archive');

//cart của user

Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    // 
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/update/{id}', [CartController::class, 'updateCartItem'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'removeCartItem'])->name('cart.remove');
    Route::post('/cart/remove-all', [CartController::class, 'removeAll'])->name('cart.removeAll');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::post('/cart/apply-discount', [CartController::class, 'applyDiscount'])->name('cart.applyDiscount');
    Route::post('/cart/check-stock', [CartController::class, 'checkStock'])->name('cart.checkStock');


    Route::post('/cart/select-items', [CartController::class, 'selectItems'])->name('cart.selectItems');

    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::get('/checkout/quantity', [CheckoutController::class, 'getQuantity']);

    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'handleCheckout'])->name('checkout.handle');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'checkoutSuccess'])->name('checkout.success');
    Route::match(['get', 'post'], '/checkout/payment/return', [CheckoutController::class, 'vnpayReturn'])->name('vnpay.return');

    Route::get('/checkout/failed', function () {
        return view('checkout.failed');
    })->name('checkout.failed');

    Route::match(['get', 'post'], '/checkout/payment', [CheckoutController::class, 'vnpay_payment'])->name('vnpay.payment');
    Route::get('/checkout/payment/return', [CheckoutController::class, 'vnpayReturn'])->name('vnpay.return');

    Route::get('/orders', [OrderController::class, 'index'])->name('order')->middleware('auth');
    Route::get('/orders/completed', [OrderController::class, 'showCompleted'])->name('orders.completed');
    Route::get('/user/orders/completed-canceled', [OrderController::class, 'showCompletedAndCanceled'])->name('orders.completed-canceled');

    // Route::post('/orders', [OrderController::class, 'store'])->name('orders.store'); // Store route
    Route::post('/orders/review', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{order}/review', [OrderController::class, 'store'])->name('orders.store');
    Route::get('product/{product}', [OrderController::class, 'show'])->name('product.show');

    Route::put('/orders/update-address/{order}', [OrderController::class, 'updateAddress'])->name('orders.updateAddress');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/orders', [OrderController::class, 'index'])->name('order')->middleware('auth');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/annalist', [AnnalistController::class, 'index'])->name('admin.annalist');

    // Quản lý bình luận
    Route::resource('review',ReviewAdminController::class);
    Route::get('/admin/review', function () {
        return view('admin.reviews.index');
    });
    // route oder
   
    Route::get('admin/orders/create', [OrderItemController::class, 'create'])->name('admin.orders.create');
    Route::post('/admin/orders', [OrderManagementController::class, 'store'])->name('admin.orders.store');
    Route::get('/orders', [OrderManagementController::class, 'index'])->name('admin.orders.index');
    Route::post('admin/orders', [OrderItemController::class, 'store'])->name('admin.orders.store');
    Route::get('admin/orders/{order}/edit', [OrderManagementController::class, 'edit'])->name('admin.orders.edit');
    Route::put('admin/orders/{order}', [OrderManagementController::class, 'update'])->name('admin.orders.update');
    Route::get('/admin/orders', [OrderManagementController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/completed', [OrderManagementController::class, 'showCompletedOrders'])->name('admin.orders.completed');
    Route::get('/admin/orders/canceled', [OrderManagementController::class, 'showCanceledOrders'])->name('admin.orders.canceled');
    Route::get('/admin/orders/{order}', [OrderManagementController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders/{order}/update-status', [OrderManagementController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // Route danh mục
    Route::resource('categories', CategoryController::class);
    Route::get('/admin/categories', function () {
        return view('admin.categories.index');
    });
    // Route người dùng
    Route::resource('users', UserController::class);
    Route::get('/admin/users', function () {
        return view('admin.users.index');
    });
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');

    // Route biến thể
    
    Route::resource('variants', VariantController::class);
    Route::get('/admin/variants', function () {
        return view('admin.variants.index');
    });

    Route::post('/products/{product}/toggle', [ProductController::class, 'toggleActive'])->name('products.toggle');


    // Route sản phẩm
    Route::resource('products', ProductController::class);
    Route::get('/admin/products/search', [ProductController::class, 'search'])->name('admin.products.search');

    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/admin/products', function () {
        return view('admin.products.index');
    });

    // Route nhà cung cấp
    Route::resource('suppliers', SupplierController::class);
    Route::get('/admin/suppliers', function () {
        return view('admin.suppliers.index');
    });
    // Route màn hình
    Route::resource('screens', ScreenController::class);
    Route::get('/admin/screens', function () {
        return view('admin.screens.index');
    });
    //ảnh
    Route::resource('product_image', ProductImageController::class);

    Route::get('/products/{product}/colours', [ProductImageController::class, 'getColours'])->name('products.colours');

    Route::get('/admin/product_image', function () {
        return view('admin.product_image.index');
    });
    // Route màu sắc
    Route::resource('colours', ColourController::class);
    Route::get('/admin/colors/search', [ColourController::class, 'search'])->name('admin.colors.search');

    

    Route::resource('product_variants', ProductVariantController::class);
    // Routes của Product Variants

    // Route pin
    Route::resource('batterys', BatteryController::class);
    Route::get('/admin/batterys', function () {
        return view('admin.batterys.index');
    });

    // Route bài viết
    Route::post('/ckeditor/upload', [PostController::class, 'upload'])->name('ckeditor.upload');
    Route::resource('/posts', PostController::class);
    Route::get('admin/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/admin/posts', function () {
        return view('admin.posts.index');
    });

    Route::get('admin', [AuthController::class, 'dashboard'])
        ->name('dashboard')
        ->middleware(['admin']);
});
// Route login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Route forgot password
Route::get('password/forgot', [AuthController::class, 'ForgotForm'])->name('password.request');
Route::post('password/forgot', [AuthController::class, 'sendPasswordResetLink'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

// Auth::routes(['verify' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::resource('discount_codes', DiscountCodeController::class);
    Route::get('/discount/select-products', [DiscountCodeController::class, 'selectProducts'])->name('discount.selectProducts');
    Route::post('/discount/apply-products', [DiscountCodeController::class, 'applyToProducts'])->name('discount.applyToProducts');
    Route::post('/discount_codes/sendToAll', [DiscountCodeController::class, 'sendToAll'])->name('discount_codes.sendToAll');
    Route::get('/discount_codes/{discountCode}/select-users', [DiscountCodeController::class, 'selectUsers'])->name('discount_codes.selectUsers');
    Route::post('/discount_codes/sendToSelectedUsers', [DiscountCodeController::class, 'sendToSelectedUsers'])->name('discount_codes.sendToSelectedUsers');
    Route::post('/discount_codes/send', [DiscountCodeController::class, 'sendToAll'])->name('discount_codes.sendDiscountCodes');
});



// User Chat
Route::middleware('web')->group(function () {
    Route::get('/chat', action: [ChatController::class, 'getMessages'])->name('user.chat');

    Route::post('/chat/send', action: [ChatController::class, 'sendMessage'])->name('user.chat.send');

    Route::post('/chat/mark-read', [ChatController::class, 'markAdminMessagesAsRead'])->name('chat.markRead');
});

// Admin Chat
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/chat', [AdminChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{id}/{type}', [AdminChatController::class, 'getMessages'])->name('chat.view');
    Route::post('/chat/{id}/{type}', [AdminChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/refresh/{id}/{type}', [AdminChatController::class, 'refreshMessages'])->name('chat.refresh');
    Route::get('/chat/users', [AdminChatController::class, 'getUserMessages'])->name('chat.users');
    Route::get('/chat/sidebar', [AdminChatController::class, 'getChatSidebar'])->name('chat.sidebar');
});
