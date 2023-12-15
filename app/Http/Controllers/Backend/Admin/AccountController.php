<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function getAccountUser()
    {

        $users = User::where('role', 'user')->orWhere('role', 'vendor')->orderBy('id', 'DESC')->get();
        return view('admin.account.user.index', compact('users'));
    }

    public function createAccountUser()
    {
        return view('admin.account.user.create');
    }

    public function storeAccountUser(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', 'min:8'],
                'role' => ['required']
            ],
            [
                'name.required' => 'Vui lòng nhập tên.',
                'email.required' => 'Vui lòng nhập email.',
                'email.unique' => 'Địa chỉ email đã tồn tại.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải lớn hơn 8 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng.',
                'role.required' => 'Vui lòng chọn loại tài khoản.',
            ]
        );

        if ($request->role == 'user') {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->status = 'active';
            $user->save();

            toastr()->success('Tạo tài khoản thành công!', ' ');
            return redirect()->back();
        } elseif ($request->role == 'vendor') {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->status = 'active';
            $user->save();

            $vendor = new Vendor();
            $vendor->banner = 'uploads/default-image.png';
            $vendor->email = $request->email;
            $vendor->shop_name = ' ';
            $vendor->phone = ' ';
            $vendor->address = ' ';
            $vendor->description = ' ';
            $vendor->user_id = $user->id;
            $vendor->status = 1;
            $vendor->save();

            toastr()->success('Tạo tài khoản thành công!', ' ');
            return redirect()->back();
        }
    }


    public function changeStatusAccountUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status == 'true' ? 'active' : 'inactive';
        $user->save();

        if ($user->status == 'active') {
            return response(['message' => 'Cho phép hoạt động']);
        } else if ($user->status == 'inactive') {
            return response(['message' => 'Không cho phép hoạt động']);
        }
    }

    public function getAccountAdmin()
    {

        $users = User::where('role', 'admin')->orderBy('id', 'ASC')->get();
        return view('admin.account.admin.index', compact('users'));
    }

    public function createAccountAdmin()
    {
        return view('admin.account.admin.create');
    }

    public function storeAccountAdmin(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', 'min:8'],
                'role' => ['required']
            ],
            [
                'name.required' => 'Vui lòng nhập tên.',
                'email.required' => 'Vui lòng nhập email.',
                'email.unique' => 'Địa chỉ email đã tồn tại.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải lớn hơn 8 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng.',
                'role.required' => 'Vui lòng chọn loại tài khoản.',
            ]
        );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->status = 'active';
        $user->save();

        toastr()->success('Tạo tài khoản thành công!', ' ');
        return redirect()->back();
    }


    public function changeStatusAccountAdmin(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status == 'true' ? 'active' : 'inactive';
        $user->save();

        if ($user->status == 'active') {
            return response(['message' => 'Cho phép hoạt động']);
        } else if ($user->status == 'inactive') {
            return response(['message' => 'Không cho phép hoạt động']);
        }
    }

    public function destroyAccountAdmin(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }
}
