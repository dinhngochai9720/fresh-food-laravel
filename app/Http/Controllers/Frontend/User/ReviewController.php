<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ProductReviewImage;
use Illuminate\Http\Request;
use App\Traits\HandlerImage;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    use HandlerImage;

    public function index()
    {

        $reviews = ProductReview::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.user.review.index', compact('reviews'));
    }
    public function create(Request $request)
    {
        $request->validate(
            [
                'rating' => ['required'],
                'review' => ['required'],
                'images.*' => ['image'],
            ],
            [
                'rating.required' => 'Vui lòng chọn đánh giá.',
                'review.required' => 'Vui lòng viết đánh giá.',
                'images.*.image' => 'Vui lòng chọn đúng định dạng file ảnh.',
            ]
        );

        // $check_exist_review = ProductReview::where(['product_id' => $request->product_id, 'user_id' => Auth::user()->id])->first();
        // if ($check_exist_review) {
        //     toastr()->warning('Sản phẩm đã đánh giá!', ' ');
        //     return redirect()->back();
        // }

        $array_image_paths = $this->uploadMultiImage($request, 'images', 'uploads/review', 70, 70);

        $product_review = new ProductReview();
        $product_review->product_id = $request->product_id;
        $product_review->vendor_id = $request->vendor_id;
        $product_review->user_id = Auth::user()->id;
        $product_review->rating = $request->rating;
        $product_review->review = $request->review;
        $product_review->status = 0;
        $product_review->save();

        if (!empty($array_image_paths)) {

            foreach ($array_image_paths as $key => $path) {
                $product_review_image = new ProductReviewImage();
                $product_review_image->product_review_id = $product_review->id;
                $product_review_image->image = $path;
                $product_review_image->save();
            }
        }

        toastr()->success('Đã đánh giá sản phẩm!', ' ');
        return redirect()->back();
    }
}
