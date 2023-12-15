<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function index()
    {

        $reviews = ProductReview::where(['vendor_id' => Auth::user()->vendor->id, 'status' => 1])->orderBy('id', 'DESC')->get();
        return view('vendor.product.review.index', compact('reviews'));
    }
}
