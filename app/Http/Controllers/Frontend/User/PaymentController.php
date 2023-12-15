<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Cart;

class PaymentController extends Controller
{
    public function index()
    {
        $cart_items = Cart::content();

        // if cart is empty
        if ($cart_items->count() == 0) {
            return view('frontend.pages.cart-detail', compact('cart_items'));
        }

        // if do not choose address -> redirect checkout url
        if (!Session::has('address')) {
            return redirect()->route('user.checkout');
        }


        return view('frontend.pages.payment.index');
    }

    public function paymentSuccess(Request $request)
    {
        return view('frontend.pages.payment.payment-success');
    }
}
