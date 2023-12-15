<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();
        $shippings = Shipping::where('status', 1)->get();
        $cart_items = Cart::content();

        // if cart is empty
        if ($cart_items->count() == 0) {
            return view('frontend.pages.cart-detail', compact('cart_items'));
        }

        return view('frontend.pages.checkout', compact('addresses', 'shippings'));
    }

    public function addNewAddress(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'phone' => ['required'],
                'city' => ['required'],
                'district' => ['required'],
                'ward' => ['required'],
                'address' => ['required'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên.',
                'name.max' => 'Nhập tối đa 255 ký tự.',
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Vui lòng nhập đúng định dạng email',
                'phone.required' => 'Vui lòng nhập điện thoại.',
                'city.required' => 'Vui lòng nhập tỉnh/thành phố.',
                'district.required' => 'Vui lòng nhập quận/huyện.',
                'ward.required' => 'Vui lòng nhập xã/phường.',
                'address.required' => 'Vui lòng nhập địa chỉ.',

            ]
        );

        $address = new UserAddress();
        $address->user_id = Auth::user()->id;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->city = $request->city;
        $address->district = $request->district;
        $address->ward = $request->ward;
        $address->address = $request->address;
        $address->save();

        toastr()->success('Thêm mới thành công!', ' ');
        return redirect()->back();
    }

    public function submit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'shipping_method_id' => ['required', 'integer'],
            'address_id' => ['required', 'integer']
        ]);

        $shipping = Shipping::findOrFail($request->shipping_method_id)->toArray();
        if ($shipping) {
            Session::put(
                'shipping',
                $shipping
            );
        }

        $address = UserAddress::findOrFail($request->address_id)->toArray();
        if ($address) {
            Session::put(
                'address',
                $address
            );
        }

        return response(['status' => 'success', 'redirect_url' => route('user.payment')]);
    }
}
