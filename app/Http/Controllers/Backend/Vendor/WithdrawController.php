<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\WithdrawMethod;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class WithdrawController extends Controller
{
    public function index()
    {

        $orders_delivered = Order::where('payment_status', 1)->where('status', 'delivered')->whereHas('orderDetail', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->get();

        $total_invoice = 0;
        foreach ($orders_delivered as $key => $order) {
            foreach ($order->orderDetail as $key => $product) {
                if ($product->vendor_id == Auth::user()->vendor->id) {
                    $product_price = $product->product_price + $product->variant_total_price;
                    $total_invoice += $product_price * $product->product_qty;
                }
            }
        }

        $withdraw_paid_total_amount = WithdrawRequest::where('vendor_id', Auth::user()->vendor->id)->where('status', 'paid')->sum('total_amount');

        $current_balance = $total_invoice - $withdraw_paid_total_amount;

        $withdraw_pending_total_amount = WithdrawRequest::where('vendor_id', Auth::user()->vendor->id)->where('status', 'pending')->sum('total_amount');

        $withdraw_requests = WithdrawRequest::where('vendor_id', Auth::user()->vendor->id)->get();
        return view('vendor.withdraw.index', compact('withdraw_requests', 'current_balance', 'withdraw_paid_total_amount', 'withdraw_pending_total_amount'));
    }

    public function create()
    {
        $withdraw_methods = WithdrawMethod::all();
        return view('vendor.withdraw.create', compact('withdraw_methods'));
    }

    public function withdrawMethodDescription(string $id)
    {
        $withdraw_method_desc = WithdrawMethod::findOrFail($id);

        return response($withdraw_method_desc);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'method' => ['required'],
                'total_amount' => ['required'],
                'account_info' => ['required'],
            ],
            [
                'method.required' => 'Vui lòng chọn phương thức rút tiền.',
                'total_amount.required' => 'Vui lòng nhập số tiền rút.',
                'account_info.required' => 'Vui lòng nhập thông tin tài khoản.',

            ]
        );

        // validate
        $withdraw_method = WithdrawMethod::findOrFail($request->method);
        if ($request->total_amount < $withdraw_method->minimum_amount || $request->total_amount > $withdraw_method->maximum_amount) {
            throw ValidationException::withMessages([
                'total_amount' => [
                    "Vui lòng nhập số tiền rút từ " . number_format($withdraw_method->minimum_amount, 0, '.', '.') . "đ đến " . number_format($withdraw_method->maximum_amount, 0, '.', '.') . "đ"
                ],
            ]);
        }

        // validate: check total_amount > current_balance?
        $orders_delivered = Order::where('payment_status', 1)->where('status', 'delivered')->whereHas('orderDetail', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->get();
        $total_invoice = 0;
        foreach ($orders_delivered as $key => $order) {
            foreach ($order->orderDetail as $key => $product) {
                if ($product->vendor_id == Auth::user()->vendor->id) {
                    $product_price = $product->product_price + $product->variant_total_price;
                    $total_invoice += $product_price * $product->product_qty;
                }
            }
        }
        $withdraw_paid_total_amount = WithdrawRequest::where('vendor_id', Auth::user()->vendor->id)->where('status', 'paid')->sum('total_amount');
        $current_balance = $total_invoice - $withdraw_paid_total_amount;
        if ($request->total_amount > $current_balance) {
            throw ValidationException::withMessages([
                'total_amount' => [
                    "Số dư không đủ"
                ],
            ]);
        }

        // Check exists withdraw request (status =='pending')?
        if (WithdrawRequest::where(['vendor_id' => Auth::user()->vendor->id, 'status' => 'pending'])->exists()) {
            toastr()->warning('Đã gửi yêu cầu rút tiền. Vui lòng chờ phê duyệt!', ' ');
            return redirect()->back();
        } else {
            $withdraw_request = new WithdrawRequest();
            $withdraw_request->vendor_id = Auth::user()->vendor->id;
            $withdraw_request->method = $withdraw_method->name;
            $withdraw_request->total_amount = $request->total_amount;
            $withdraw_request->withdraw_amount =  $request->total_amount - (($withdraw_method->withdraw_charge / 100) * $request->total_amount);
            $withdraw_request->charge_amount =  ($withdraw_method->withdraw_charge / 100) * $request->total_amount;
            $withdraw_request->account_info = $request->account_info;
            $withdraw_request->save();

            toastr()->success('Gửi yêu cầu thành công!', ' ');
            return redirect()->back();
        }
    }

    public function showDetailWithdrawRequest(string $id)
    {
        $withdraw_request = WithdrawRequest::where('vendor_id', Auth::user()->vendor->id)->findOrFail($id);
        return view('vendor.withdraw.detail', compact('withdraw_request'));
    }
}
