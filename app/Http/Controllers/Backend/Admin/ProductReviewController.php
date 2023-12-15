<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function index()
    {

        $reviews = ProductReview::orderBy('id', 'DESC')->get();
        return view('admin.product.review.index', compact('reviews'));
    }

    public function changeStatus(Request $request)
    {
        $review = ProductReview::findOrFail($request->id);
        $review->status = $request->status == 'true' ? 1 : 0;
        $review->save();

        if ($review->status == 1) {
            return response(['message' => 'Hiển thị đánh giá']);
        } else if ($review->status == 0) {
            return response(['message' => 'Ẩn đánh giá']);
        }
    }
}
