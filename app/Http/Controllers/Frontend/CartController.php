<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariantItem;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function buyProductNow(Request $request)
    {
        // refresh voucher
        if (Session::has('voucher')) {
            Session::forget('voucher');
        }

        // dd($request->all()); 
        $product = Product::findOrFail($request->product_id);

        // check product quantity
        if ($product->quantity  == 0) {
            return response(['status' => 'error', 'message' => 'Sản phẩm đã bán hết!']);
        } else if ($request->quantity > $product->quantity) {
            return response(['status' => 'warning', 'message' => 'Vượt quá sản phẩm có sẵn!']);
        }

        $variants = [];
        $variant_total_price = 0;
        $product_price = 0;

        // Check has variant_item
        if ($request->has('variant_items')) {
            foreach ($request->variant_items as $variant_item_id) {
                $variant_item = ProductVariantItem::findOrFail($variant_item_id);

                $variants[$variant_item->variant->name]['name'] =   $variant_item->name;
                $variants[$variant_item->variant->name]['price'] =   $variant_item->price;
                $variant_total_price += $variant_item->price;
            }
        }
        // dd($variants);


        // Check discount product
        if (checkDiscountProduct($product)) {
            // discount
            $product_price = $product->offer_price;
        } else {
            // no discount
            $product_price = $product->price;
        }

        $cart_data = [];
        $cart_data['id'] = $product->id;
        $cart_data['name'] = $product->name;
        $cart_data['qty'] = $request->quantity;
        $cart_data['price'] = $product_price;
        $cart_data['weight'] = 0;
        $cart_data['options']['variants'] =  $variants;
        $cart_data['options']['variant_total_price'] =  $variant_total_price;
        $cart_data['options']['thumbnail_image'] =  $product->thumbnail_image;
        $cart_data['options']['slug'] =  $product->slug;
        // dd($cart_data);

        Cart::add($cart_data);
        return response(['status' => 'success', 'message' => 'Đã thêm sản phẩm vào giỏ hàng!']);
    }

    public function addProductToCart(Request $request)
    {
        // refresh voucher
        if (Session::has('voucher')) {
            Session::forget('voucher');
        }

        // dd($request->all()); 
        $product = Product::findOrFail($request->product_id);

        // check product quantity
        if ($product->quantity  == 0) {
            return response(['status' => 'error', 'message' => 'Sản phẩm đã bán hết!']);
        } else if ($request->quantity > $product->quantity) {
            return response(['status' => 'warning', 'message' => 'Vượt quá sản phẩm có sẵn!']);
        }

        $variants = [];
        $variant_total_price = 0;
        $product_price = 0;

        // Check has variant_item
        if ($request->has('variant_items')) {
            foreach ($request->variant_items as $variant_item_id) {
                $variant_item = ProductVariantItem::findOrFail($variant_item_id);

                $variants[$variant_item->variant->name]['name'] =   $variant_item->name;
                $variants[$variant_item->variant->name]['price'] =   $variant_item->price;
                $variant_total_price += $variant_item->price;
            }
        }
        // dd($variants);


        // Check discount product
        if (checkDiscountProduct($product)) {
            // discount
            $product_price = $product->offer_price;
        } else {
            // no discount
            $product_price = $product->price;
        }

        $cart_data = [];
        $cart_data['id'] = $product->id;
        $cart_data['name'] = $product->name;
        $cart_data['qty'] = $request->quantity;
        $cart_data['price'] = $product_price;
        $cart_data['weight'] = 0;
        $cart_data['options']['variants'] =  $variants;
        $cart_data['options']['variant_total_price'] =  $variant_total_price;
        $cart_data['options']['thumbnail_image'] =  $product->thumbnail_image;
        $cart_data['options']['slug'] =  $product->slug;
        // dd($cart_data);

        Cart::add($cart_data);
        return response(['status' => 'success', 'message' => 'Đã thêm sản phẩm vào giỏ hàng!']);
    }

    public function viewCartDetails()
    {


        $cart_page_banner = Advertisement::where('key', 'cart_page_banner')->first();
        $cart_page_banner = json_decode($cart_page_banner->value);

        $cart_items = Cart::content();
        // dd($cart_items);

        if ($cart_items->count() == 0) {
            // if cart is empty
            Session::forget('voucher');
        }
        return view('frontend.pages.cart-detail', compact('cart_items', 'cart_page_banner'));
    }

    public function updateProductQuantity(Request $request)
    {
        // get id of product
        $product_id = Cart::get($request->rowId)->id;
        // dd($product_id);

        $product = Product::findOrFail($product_id);

        // check product quantity
        if ($product->quantity  == 0) {
            return response(['status' => 'error', 'message' => 'Sản phẩm đã bán hết!']);
        } else if ($request->qty > $product->quantity) {
            return response(['status' => 'warning', 'message' => 'Vượt quá sản phẩm có sẵn!']);
        }

        // dd($request->all());
        Cart::update($request->rowId, $request->qty);

        $total_product_price = $this->getTotalProductPrice($request->rowId);

        return response(['status' => 'success', 'message' => 'Đã cập nhật số lượng sản phẩm!', 'total_product_price' => $total_product_price]);
    }

    public function getTotalProductPrice($rowId)
    {
        $product = Cart::get($rowId);

        $total_product_price = ($product->price + $product->options->variant_total_price) * $product->qty;

        return $total_product_price;
    }

    public function getTotalCartPrice()
    {

        $total_cart_price = 0;

        foreach (Cart::content() as $key => $product) {
            $total_cart_price += $this->getTotalProductPrice($product->rowId);
        }

        return $total_cart_price;
    }


    public function clearCart()
    {
        Cart::destroy();

        return response(['status' => 'success', 'message' => 'Xóa giỏ hàng thành công!']);
    }

    public function deleteProductCart($rowId)
    {
        Cart::remove($rowId);

        return redirect()->back();
    }

    public function countProductCart()
    {
        return Cart::content()->count();
    }

    public function getProductsCart()
    {
        return Cart::content();
    }

    public function deleteProductMiniCart(Request $request)
    {

        // dd($request->all());
        Cart::remove($request->rowId);

        return response(['status' => 'success', 'message' => 'Xóa sản phẩm thành công!']);
    }

    public function applyVoucher(Request $request)
    {
        // check voucher already use?
        if (Auth::check()) {
            $orders = Order::where('user_id', Auth::user()->id)->get();
            foreach ($orders as $key => $order) {
                if ($order->voucher !== 'null') {
                    $voucher_decode = json_decode($order->voucher);
                    $voucher_code_name = $voucher_decode->voucher_code;

                    if (strcasecmp($voucher_code_name, $request->voucher_code) == 0) {
                        return response(['status' => 'warning', 'message' => 'Mã giảm giá đã được sử dụng!']);
                    }
                }
            }
        }

        $voucher = Voucher::where(['code' => $request->voucher_code, 'status' => 1])->first();

        if ($request->voucher_code == null) {
            return response(['status' => 'warning', 'message' => 'Vui lòng nhập mã giảm giá!']);
        }

        if ($voucher == null) {
            return response(['status' => 'error', 'message' => 'Mã giảm giá không tồn tại!']);
        } elseif (date('Y-m-d') < $voucher->start_date) {
            return response(['status' => 'error', 'message' => 'Mã giảm giá không tồn tại!']);
        } elseif (date('Y-m-d') > $voucher->end_date) {
            return response(['status' => 'error', 'message' => 'Mã giảm giá đã hết hạn!']);
        } elseif ($voucher->quantity <= 0) {
            return response(['status' => 'error', 'message' => 'Mã giảm giá đã hết!']);
        }

        if ($voucher->voucher_type == 'amount') {
            Session::put(
                'voucher',
                [
                    'voucher_id' => $voucher->id,
                    'voucher_name' => $voucher->name,
                    'voucher_code' => $voucher->code,
                    'voucher_type' => 'amount',
                    'voucher_discount' => $voucher->discount,
                ]
            );
        } elseif ($voucher->voucher_type == 'percent') {
            Session::put(
                'voucher',
                [
                    'voucher_id' => $voucher->id,
                    'voucher_name' => $voucher->name,
                    'voucher_code' => $voucher->code,
                    'voucher_type' => 'percent',
                    'voucher_discount' => $voucher->discount,
                ]
            );
        }

        return response(['status' => 'success', 'message' => 'Áp dụng mã giảm giá thành công!']);
    }

    public function deleteVoucher()
    {
        if (Session::has('voucher')) {
            Session::forget('voucher');
            return response(['status' => 'success', 'message' => 'Hủy mã giảm giá thành công!']);
        } else {
            return response(['status' => 'error', 'message' => 'Mã giảm giá không tồn tại!']);
        }
    }

    public function  calculateVoucherDiscount()
    {
        // has voucher
        if (Session::has('voucher')) {
            $voucher = Session::get('voucher');
            $total_cart_price = getTotalCartPrice();

            // discount is amount
            if ($voucher['voucher_type'] == 'amount') {
                $final_total_cart_price = $total_cart_price - $voucher['voucher_discount'];
                return response(['status' => 'success', 'final_total_cart_price' => $final_total_cart_price, 'discount' => $voucher['voucher_discount']]);
            }
            // discount is percent
            elseif ($voucher['voucher_type'] == 'percent') {
                $discount = $voucher['voucher_discount'] / 100 * $total_cart_price;
                $final_total_cart_price = $total_cart_price - $discount;
                return response(['status' => 'success', 'final_total_cart_price' => $final_total_cart_price, 'discount' => $discount]);
            }
        }
        // has not voucher
        else {
            $final_total_cart_price = getTotalCartPrice();
            return response(['status' => 'success', 'final_total_cart_price' => $final_total_cart_price, 'discount' => 0]);
        }
    }
}
