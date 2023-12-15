<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
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

    public function paypalConfig()
    {
        $paypal_setting = PayPalSetting::first();
        $config = [
            'mode'    =>  $paypal_setting->account_mode == 1 ? 'live' : "sandbox",
            'sandbox' => [
                'client_id'         => $paypal_setting->client_id,
                'client_secret'     => $paypal_setting->secret_key,
                'app_id'            => '',
            ],
            'live' => [
                'client_id'         => $paypal_setting->client_id,
                'client_secret'     => $paypal_setting->secret_key,
                'app_id'            => '',
            ],

            'payment_action' =>  'Sale',
            'currency'       => $paypal_setting->currency_name,
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];

        return $config;
    }

    public function payWithPayPal()
    {
        $paypal_setting = PayPalSetting::first();
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        // calculate the payable amount depending on the currency rate
        $total = getNetFinalToTalCartPrice();
        $payable_paypal = round($total / $paypal_setting->currency_rate, 2);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.payment.paypal-success'),
                "cancel_url" => route('user.payment.paypal-cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" =>   $payable_paypal
                    ]
                ]
            ]
        ]);


        if (isset($response['id']) && $response['id'] !== null) {
            foreach ($response['links'] as  $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('user.payment.paypal-cancel');
        }
    }

    public function payWithPayPalSuccess(Request $request)
    {
        $paypal_setting = PaypalSetting::first();
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // calculate the payable amount depending on the currency rate
            $total = getNetFinalToTalCartPrice();

            // covert to usd
            $net_final_total_price = round($total / $paypal_setting->currency_rate, 2);

            $this->storeOrder('paypal', 1, $response['id'],  $paypal_setting->currency_name, $net_final_total_price);

            // clear session
            $this->clearSession();

            return redirect()->route('user.payment-success');
        }

        return redirect()->route('user.payment.paypal-cancel');
    }
    public function payWithPayPalCancel()
    {
        toastr()->warning('Đã xảy ra lỗi. Vui lòng thử lại!', ' ');
        return redirect()->route('user.payment');
    }
}
