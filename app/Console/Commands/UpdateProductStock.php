<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class UpdateProductStock extends Command
{
    protected $signature = 'update:product-stock';
    protected $description = 'Cập nhật lại tổng số lượng stock từ bảng màu sắc';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Lấy tất cả sản phẩm và cập nhật lại tổng số lượng stock từ màu sắc
        $products = Product::with('colours')->get();

        foreach ($products as $product) {
            $product->updateStockFromColours(); // Cập nhật cột stock với tổng số lượng từ bảng colours
        }

        $this->info('Cập nhật stock thành công!');
    }
}
//php artisan update:product-stock