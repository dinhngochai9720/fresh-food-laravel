<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\HandlerImage;
use File;

class ProfileController extends Controller
{
    use HandlerImage;

    public function index()
    {
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request)
    {
        $request->validate(
            [
                'image' => ['image'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::user()->id],
                'phone' => ['required'],
            ],
            [
                'image.image' => 'Vui lòng chọn đúng định dạng file ảnh.',
                'name.required' => 'Vui lòng nhập tên.',
                'email.required' => 'Vui lòng nhập email.',
                'email.unique' => 'Địa chỉ email đã tồn tại.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
            ]
        );

        $admin = Auth::user();

        // Handle file image update
        $image_path = $this->updateImage($request, 'image', 'uploads/admin', 100, 100, $admin->image);
        $admin->image = !empty($image_path) ? $image_path : $admin->image;
        $admin->name = $request->name;
        $admin->email  = $request->email;
        $admin->phone  = $request->phone;
        $admin->save();

        toastr()->success('Cập nhật thành công', ' ');
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $request->validate(
            [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'confirmed', 'min:8']
            ],
            [
                'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
                'current_password.current_password' => 'Mật khẩu hiện tại không đúng.',
                'password.required' => 'Vui lòng nhập mật khẩu mới.',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng.',
                'password.min' => 'Mật khẩu phải lớn hơn 8 ký tự.',

            ]
        );

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Đổi mật khẩu thành công', ' ');
        return redirect()->back();
    }
}
