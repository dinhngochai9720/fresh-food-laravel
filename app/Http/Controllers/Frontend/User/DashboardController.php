<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $total_order = Order::where('user_id', Auth::user()->id)->count();
        $total_order_delivered = Order::where('status', 'delivered')->where('user_id', Auth::user()->id)->count();
        $total_order_cancelled = Order::where('status', 'cancelled')->where('user_id', Auth::user()->id)->count();
        $total_review = ProductReview::where('user_id', Auth::user()->id)->count();
        $total_wishlist = Wishlist::where('user_id', Auth::user()->id)->count();
        return view(
            'frontend.user.dashboard',
            compact(
                'total_order',
                'total_order_delivered',
                'total_order_cancelled',
                'total_review',
                'total_wishlist'
            )
        );
    }
}
