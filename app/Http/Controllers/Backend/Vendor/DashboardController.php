<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function dashboard()
    {

        $total_order_today = Order::whereDate('created_at', Carbon::today())->whereHas('orderDetail', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $total_order = Order::whereHas('orderDetail', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $total_order_delivered = Order::where('status', 'delivered')->whereHas('orderDetail', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $total_order_cancelled = Order::where('status', 'cancelled')->whereHas('orderDetail', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $total_order_pending = Order::where('status', 'pending')->whereHas('orderDetail', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $total_product = Product::where('vendor_id',  Auth::user()->vendor->id)->count();

        $orders_delivered_today = Order::where('payment_status', 1)->whereDate('created_at', Carbon::today())->where('status', 'delivered')->whereHas('orderDetail', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->get();

        $orders_delivered_month = Order::where('payment_status', 1)->whereMonth('created_at', Carbon::now()->month)->where('status', 'delivered')->whereHas('orderDetail', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->get();

        $orders_delivered_year = Order::where('payment_status', 1)->whereYear('created_at', Carbon::now()->year)->where('status', 'delivered')->whereHas('orderDetail', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->get();

        $orders_delivered = Order::where('payment_status', 1)->where('status', 'delivered')->whereHas('orderDetail', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->get();

        $total_review = ProductReview::where('vendor_id', Auth::user()->vendor->id)->count();

        return view('vendor.dashboard', compact('total_order_today', 'total_order', 'total_order_delivered', 'total_order_cancelled', 'total_order_pending', 'total_product', 'orders_delivered_today', 'orders_delivered_month', 'orders_delivered_year', 'orders_delivered', 'total_review'));
    }
}
