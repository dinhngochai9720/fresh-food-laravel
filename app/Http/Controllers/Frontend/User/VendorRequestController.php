<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorCondition;
use Illuminate\Http\Request;
use App\Traits\HandlerImage;
use Illuminate\Support\Facades\Auth;

class VendorRequestController extends Controller
{
    use HandlerImage;
    public function index()
    {
        return view('frontend.user.vendor-request.index');
    }

    public function create(Request $request)
    {

        $request->validate(
            [
                'banner' => ['required', 'image'],
                'shop_name' => ['required', 'max:255'],
                'phone' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'address' => ['required'],
                'description' => ['required'],
            ],
            [
                'banner.required' => 'Vui lòng chọn ảnh.',
                'banner.image' => 'Vui lòng chọn lại đúng định dạnh file ảnh.',
                'shop_name.required' => 'Vui lòng nhập tên cửa hàng.',
                'shop_name.max' => 'Nhập tối đa 255 ký tự.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'email.required' => 'Vui lòng nhập email.',
                'address.required' => 'Vui lòng nhập địa chỉ.',
                'description.required' => 'Vui lòng nhập mô tả.',
            ]
        );


        // $info_exist_vendor = Vendor::where('user_id', Auth::user()->id)->first();
        // if ($info_exist_vendor) {
        //     toastr()->warning('Tài khoản đã đăng ký thông tin! Vui lòng chờ phê duyệt', ' ');
        //     return redirect()->back();
        // }

        $vendor = new Vendor();
        // Handle file image upload
        $image_path = $this->uploadImage($request, 'banner', 'uploads/vendor', 250, 250);

        $vendor->banner = $image_path;
        $vendor->shop_name = $request->shop_name;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->user_id = Auth::user()->id;
        $vendor->status = 0;
        $vendor->save();

        toastr()->success('Đăng ký thông tin thành công!', ' ');
        return redirect()->back();
    }
}
