<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist_products = Wishlist::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.pages.wishlist', compact('wishlist_products'));
    }

    public function addProductToWishlist(Request $request)
    {
        if (!Auth::check()) {
            // return response(['status' => 'warning', 'message' => 'Vui lòng đăng nhập!']);
        }

        $check_product_wishlist = Wishlist::where(['product_id' => $request->id, 'user_id' => Auth::user()->id]);
        if ($check_product_wishlist->count() > 0) {
            return response(['status' => 'error', 'message' => 'Sản phẩm đã tồn tại!']);
        }

        $wishlist = new Wishlist();
        $wishlist->product_id = $request->id;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->save();

        return response(['status' => 'success', 'message' => 'Đã thêm sản phẩm vào yêu thích!']);
    }

    public function countProductWishlist()
    {
        $total_wishlist_products = Wishlist::where('user_id', Auth::user()->id)->count();
        return $total_wishlist_products;
    }


    public function deleteProductWishlist(string $id)
    {
        $wishlist_product = Wishlist::findOrFail($id);

        // product do not user add wishlist
        if ($wishlist_product->user_id !== Auth::user()->id) {
            return redirect()->back();
        }

        $wishlist_product->delete();

        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }
}
