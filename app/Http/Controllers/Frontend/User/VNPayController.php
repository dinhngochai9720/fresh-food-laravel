<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Exception;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\VNPaySetting;
use Illuminate\Support\Facades\Session;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class VNPayController extends Controller
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


    public function clearSession()
    {
        Cart::destroy();
        Session::forget('voucher');
        Session::forget('shipping');
        Session::forget('address');
    }

    public function payWithVNPay()
    {
        $vnpay_setting = VNPaySetting::first();
        $setting = GeneralSetting::first();
        $invoice_id = mt_rand(1000000, 9999999);
        $net_final_total_price = getNetFinalToTalCartPrice();

        $vnp_Url =  $vnpay_setting->url; // url thanh toan cua vnpay
        $vnp_Returnurl = route('user.payment.vnpay-return'); // xac nhan thanh toan hoac huy thanh toan => chuyen huong url nay
        $vnp_TmnCode = $vnpay_setting->tmncode; // Ma website vnpay
        $vnp_HashSecret = $vnpay_setting->hashsecret; // chuoi bi mat

        $vnp_TxnRef = $invoice_id; // ma don hang
        $vnp_OrderInfo = 'Thanh toan VNPay'; // noi dung thanh toan
        $vnp_OrderType = 100000; // ma danh muc hang hoa
        $vnp_Amount =   $net_final_total_price * 100; // tong tien thanh toan
        $vnp_Locale = 'vn'; // ngon ngu
        $vnp_BankCode = ''; // ma ngan hang
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // dia chi ip cua khach hang

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => $setting->currency_name,
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;

        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );

        // chuyen huong den trang thanh toan cua vnpay
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function payWithVNPayReturn(Request $request)
    {
        $setting = GeneralSetting::first();
        $net_final_total_price = getNetFinalToTalCartPrice();

        // Xac nhan thanh toan
        if ($request->vnp_ResponseCode == '00') {
            try {
                // luu co so du lieu
                $this->storeOrder('vnpay', 1, $this->generateRandomTransactionId(16), $setting->currency_name, $net_final_total_price);

                // xoa session
                $this->clearSession();

                return view('frontend.pages.payment.payment-success');
            } catch (Exception $exception) {
                toastr()->error('Đã xảy ra lỗi. Vui lòng thử lại!', ' ');
                return redirect()->route('home');
            }
        }

        // Huy thanh toan
        else {
            toastr()->warning('Đã hủy thanh toán đơn hàng!', ' ');
            return redirect()->route('user.payment');
        }
    }
}
