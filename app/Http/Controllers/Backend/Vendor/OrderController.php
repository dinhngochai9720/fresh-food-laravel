<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // get all orders have contain product of vendor
        $orders = Order::whereHas('orderDetail', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->orderBy('id', 'DESC')->get();

        return view('vendor.order.index', compact('orders'));
    }

    public function showOrderDetail(string $id)
    {
        $order = Order::findOrFail($id);
        return view('vendor.order.detail', compact('order'));
    }
}
