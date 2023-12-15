<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        $orders = Order::where('payment_status', 1)->where('status', 'delivered')->get();
        $flash_sale_date = FlashSale::first();
        $flash_sale_items = FlashSaleItem::where('status', 1)->orderBy('id', 'DESC')->paginate(8);
        $products = Product::where(['is_approved' => 1, 'status' => 1])->get();
        return view('frontend.pages.flash-sale', compact('flash_sale_date', 'flash_sale_items', 'products', 'orders'));
    }
}
