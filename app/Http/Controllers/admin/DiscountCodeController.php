<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DiscountCodeMail;
use Illuminate\Support\Facades\DB;

class DiscountCodeController extends Controller
{
    public function index()
    {
        // Lấy mã giảm giá và các sản phẩm liên quan
        $discountCodes = DiscountCode::with('products')
            ->select('id', 'code', 'amount', 'percentage', 'usage_limit', 'start_date', 'end_date')
            ->get();

        // Lấy danh sách tất cả người dùng (khách hàng)
        $users = User::select('id', 'name_user', 'email')->get(); // Chỉ lấy ID, tên và email

        // Trả về view với cả discountCodes và users
        return view('admin.discount_codes.index', compact('discountCodes', 'users'));
    }


    // Hiển thị form tạo mã giảm giá mới
    public function create()
    {
        // Lấy tất cả sản phẩm
        $products = Product::all();

        return view('admin.discount_codes.create', compact('products'));
    }

    // Lưu mã giảm giá mới
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'code' => 'required|string|max:255',
            'discount_type' => 'required|string',
            'amount' => 'nullable|numeric',
            'percentage' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'product_selection' => 'required|string',
        ]);

        // Create the discount code
        $discountCode = DiscountCode::create([
            'code' => $request->code,
            'discount_type' => $request->discount_type,
            'amount' => $request->amount,
            'percentage' => $request->percentage,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'usage_limit' => $request->usage_limit,
        ]);

        // Handle selected products if specific products were chosen
        if ($request->product_selection == 'specific' && $request->filled('selected_products')) {
            $selectedProducts = explode(',', $request->input('selected_products'));

            foreach ($selectedProducts as $productId) {
                DB::table('discount_code_product')->insert([
                    'discount_code_id' => $discountCode->id,
                    'product_id' => $productId,
                ]);
            }
        }

        return redirect()->route('admin.discount_codes.index')->with('success', 'Mã giảm giá đã được tạo thành công!');
    }


    // Hiển thị form chỉnh sửa mã giảm giá
    public function edit($id)
    {
        $discountCode = DiscountCode::with('products')->findOrFail($id);
        $products = Product::all(); // Lấy danh sách tất cả sản phẩm để chọn

        return view('admin.discount_codes.edit', compact('discountCode', 'products'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code' => 'required|max:255|unique:discount_codes,code,' . $id,
            'amount' => 'nullable|numeric',
            'percentage' => 'nullable|numeric|min:0|max:100',
            'usage_limit' => 'nullable|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'product_selection' => 'required', // Kiểm tra người dùng chọn tất cả hoặc sản phẩm cụ thể
        ]);

        $discountCode = DiscountCode::findOrFail($id);
        $discountCode->update($validated);

        // Xóa liên kết sản phẩm cũ nếu có
        $discountCode->products()->detach();

        if ($request->input('product_selection') === 'specific') {
            if ($request->has('selected_products')) {
                $selectedProducts = $request->input('selected_products');
                $discountCode->products()->attach($selectedProducts);
            }
        }

        return redirect()->route('admin.discount_codes.index')->with('success', 'Mã giảm giá đã được cập nhật thành công');
    }



    // Xóa mã giảm giá
    public function destroy($id)
    {
        $discountCode = DiscountCode::findOrFail($id);
        $discountCode->delete();

        return redirect()->route('admin.discount_codes.index')->with('success', 'Mã giảm giá đã được xóa thành công');
    }


    public function sendToAll(Request $request)
    {
        $validated = $request->validate([
            'discount_code_id' => 'required|exists:discount_codes,id',
        ]);

        // Nạp trước mối quan hệ products
        $discountCode = DiscountCode::with('products')->findOrFail($validated['discount_code_id']);
        $users = User::all(); // Lấy tất cả khách hàng

        foreach ($users as $user) {
            Mail::to($user->email)->send(new DiscountCodeMail($user, $discountCode)); // Gửi email với người dùng
        }

        return redirect()->route('admin.discount_codes.index')->with('success', 'Mã giảm giá đã được gửi tới tất cả khách hàng');
    }


    public function selectUsers($id, Request $request)
    {
        $discountCode = DiscountCode::findOrFail($id);

        // Kiểm tra nếu có từ khóa tìm kiếm
        $search = $request->input('search');

        if ($search) {
            // Tìm kiếm theo tên hoặc email
            $users = User::where('name_user', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->select('id', 'name_user', 'email')
                ->get();
        } else {
            // Nếu không có từ khóa, lấy tất cả người dùng
            $users = User::select('id', 'name_user', 'email')->get();
        }

        // Nếu là yêu cầu AJAX, trả về phần HTML của danh sách người dùng
        if ($request->ajax()) {
            $userListHtml = '';
            foreach ($users as $user) {
                $userListHtml .= '
                <tr>
                    <td><input type="checkbox" name="selected_users[]" value="' . $user->id . '"></td>
                    <td>' . $user->name_user . '</td>
                    <td>' . $user->email . '</td>
                </tr>';
            }

            // Nếu không có người dùng nào được tìm thấy
            if (empty($userListHtml)) {
                $userListHtml = '
                <tr>
                    <td colspan="3">Không tìm thấy khách hàng</td>
                </tr>';
            }

            return $userListHtml;
        }

        // Nếu không phải AJAX, trả về view đầy đủ
        return view('admin.discount_codes.select_users', compact('discountCode', 'users'));
    }



    // Gửi mã giảm giá tới khách hàng đã chọn
    public function sendToSelectedUsers(Request $request)
    {
        $validated = $request->validate([
            'discount_code_id' => 'required|exists:discount_codes,id',
            'selected_users' => 'required|array',
            'selected_users.*' => 'exists:users,id',
        ]);

        // Nạp trước mối quan hệ products
        $discountCode = DiscountCode::with('products')->findOrFail($validated['discount_code_id']);
        $selectedUsers = $validated['selected_users'];

        foreach ($selectedUsers as $userId) {
            $user = User::findOrFail($userId);
            Mail::to($user->email)->send(new DiscountCodeMail($user, $discountCode)); // Gửi email với người dùng
        }

        return redirect()->route('admin.discount_codes.index')->with('success', 'Mã giảm giá đã được gửi tới khách hàng đã chọn');
    }

    
}
