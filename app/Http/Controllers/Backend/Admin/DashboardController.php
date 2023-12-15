<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $total_order_today = Order::whereDate('created_at', Carbon::today())->count();
        $total_order_month = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $total_order_year = Order::whereYear('created_at', Carbon::now()->year)->count();

        $total_order = Order::count();
        $total_order_pending = Order::where('status', 'pending')->count();
        $total_order_confirmed = Order::where('status', 'confirmed')->count();
        $total_order_delivered = Order::where('status', 'delivered')->count();
        $total_order_cancelled = Order::where('status', 'cancelled')->count();

        $total_price_order_today = Order::whereDate('created_at', Carbon::today())->where('payment_status', 1)->where('status', 'delivered')->sum('total_price');
        $total_price_order_month = Order::whereMonth('created_at', Carbon::now()->month)->where('payment_status', 1)->where('status', 'delivered')->sum('total_price');
        $total_price_order_year = Order::whereYear('created_at', Carbon::now()->year)->where('payment_status', 1)->where('status', 'delivered')->sum('total_price');

        $total_price_order = Order::where('payment_status', 1)->where('status', 'delivered')->sum('total_price');
        $total_discount = Order::where('payment_status', 1)->where('status', 'delivered')->sum('discount');
        $total_final_price_order = $total_price_order - $total_discount;

        $total_shipping_fee_order = Order::where('payment_status', 1)->where('status', 'delivered')->sum('shipping_fee');
        $total_voucher = Voucher::count();

        $total_review = ProductReview::count();
        $total_brand = Brand::count();
        $total_category = Category::count();
        $total_approved_product = Product::where('is_approved', 1)->count();
        $total_pending_product = Product::where('is_approved', 0)->count();

        $total_account = User::where('role', '!=', 'admin')->count();
        $total_vendor = User::where('role', 'vendor')->count();
        $total_admin = User::where('role', 'admin')->count();

        return view('admin.dashboard', compact('total_order_today', 'total_order_month', 'total_order_year', 'total_order', 'total_order_pending', 'total_order_delivered', 'total_order_cancelled', 'total_order_confirmed', 'total_price_order_today', 'total_price_order_month', 'total_price_order_year', 'total_price_order', 'total_review', 'total_brand', 'total_category', 'total_approved_product', 'total_pending_product', 'total_account', 'total_vendor', 'total_admin', 'total_shipping_fee_order', 'total_voucher', 'total_discount', 'total_final_price_order'));
    }
}
