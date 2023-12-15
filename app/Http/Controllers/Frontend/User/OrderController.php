<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.index', compact('orders'));
    }

    public function showOrderDetail(string $id)
    {
        $order = Order::findOrFail($id);
        return view('frontend.user.order.detail', compact('order'));
    }

    public function trackOrder(Request $request)
    {
        if ($request->has('invoice_id')) {
            $order = Order::where('invoice_id', $request->invoice_id)->first();
            return view('frontend.pages.track-order', compact('order'));
        } else {
            return view('frontend.pages.track-order');
        }
    }
}
