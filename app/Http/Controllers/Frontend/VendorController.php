<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function getAllVendors()
    {
        $vendors = Vendor::where('status', 1)->orderBy('id', 'DESC')->paginate(10);
        return view('frontend.pages.vendor', compact('vendors'));
    }

    public function showVendorProducts(Request $request, string $id)
    {
        $orders = Order::where('payment_status', 1)->where('status', 'delivered')->get();
        $vendor = Vendor::findOrFail($id);
        $products = Product::where(['status' => 1, 'is_approved' => 1, 'vendor_id' => $id])
            ->orderBy('id', 'DESC')
            ->paginate(12);
        return view('frontend.pages.vendor-product', compact('products', 'vendor', 'orders'));
    }
}
