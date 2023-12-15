<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = UserAddress::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.user.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.user.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $address = UserAddress::findOrFail($id);
        return view('frontend.user.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

        $address =  UserAddress::findOrFail($id);
        $address->user_id = Auth::user()->id;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->city = $request->city;
        $address->district = $request->district;
        $address->ward = $request->ward;
        $address->address = $request->address;

        $address->save();

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->route('user.address.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = UserAddress::findOrFail($id);
        $address->delete();
        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }
}
