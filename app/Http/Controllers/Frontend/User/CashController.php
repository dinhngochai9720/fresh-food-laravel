<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\StripeSetting;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;
use Cart;

class CashController extends Controller
{
    public function storeOrder($payment_method, $payment_status, $transaction_id, $currency_name, $net_final_total_price)
    {

        $setting = GeneralSetting::first();

        // store order
        $order = new Order();
        $order->invoice_id = mt_rand(1000000, 9999999);
        $order->user_id = Auth::user()->id;
        $order->total_price = getTotalCartPrice();
        $order->final_total_price = getFinalTotalCartPrice();
        $order->shipping_fee = getShippingFee();
        $order->discount = getCartDiscount();
        $order->currency_name = $setting->currency_name;
        $order->currency_icon = $setting->currency_icon;
        $order->payment_method = $payment_method;
        $order->payment_status = $payment_status;
        $order->address = json_encode(Session::get('address'), JSON_UNESCAPED_UNICODE);
        $order->shipping = json_encode(Session::get('shipping'), JSON_UNESCAPED_UNICODE);
        $order->voucher = json_encode(Session::get('voucher'), JSON_UNESCAPED_UNICODE);
        $order->status = 'pending';
        $order->save();

        // store order details
        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->vendor_id = $product->vendor_id;
            $order_detail->product_id = $product->id;
            $order_detail->product_name = $product->name;
            $order_detail->product_price = $item->price;
            $order_detail->product_qty = $item->qty;
            $order_detail->variants = json_encode($item->options->variants, JSON_UNESCAPED_UNICODE);
            $order_detail->variant_total_price = $item->options->variant_total_price;
            $order_detail->save();
        }

        // store transactions
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $transaction_id;
        $transaction->payment_method = $payment_method;
        $transaction->currency_name = $currency_name;
        $transaction->net_final_total_price = $net_final_total_price;
        $transaction->save();

        toastr()->success('Đặt hàng thành công!', ' ');
    }

    public function clearSession()
    {
        Cart::destroy();
        Session::forget('voucher');
        Session::forget('shipping');
        Session::forget('address');
    }

    function generateRandomTransactionId($length)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $transaction_id = '';
        $max = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $transaction_id .= $characters[random_int(0, $max)];
        }

        return $transaction_id;
    }

    public function payWithCash()
    {
        $setting = GeneralSetting::first();

        $net_final_total_price = getNetFinalToTalCartPrice();

        $this->storeOrder('cash', 0, $this->generateRandomTransactionId(16), $setting->currency_name, $net_final_total_price);

        // clear session
        $this->clearSession();

        return redirect()->route('user.payment-success');
    }
}
