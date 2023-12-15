<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\HandlerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopProfileController extends Controller
{

    use HandlerImage;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::user()->id)->first();
        return view('vendor.shop-profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'banner' => ['nullable', 'image'],
                'shop_name' => ['required', 'max:255'],
                'phone' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'address' => ['required'],
                'description' => ['required'],
                'facebook_link' => ['nullable', 'url'],
                'youtube_link' => ['nullable', 'url'],
                'instagram_link' => ['nullable', 'url'],
            ],
            [
                'banner.image' => 'Vui lòng chọn lại đúng định dạnh file ảnh.',
                'shop_name.required' => 'Vui lòng nhập tên cửa hàng.',
                'shop_name.max' => 'Nhập tối đa 255 ký tự.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'email.required' => 'Vui lòng nhập email.',
                'address.required' => 'Vui lòng nhập địa chỉ.',
                'description.required' => 'Vui lòng nhập mô tả.',

                'facebook_link.url' => 'Vui lòng nhập đúng đường link facebook.',
                'youtube_link.url' => 'Vui lòng nhập đúng đường link youtube.',
                'instagram_link.url' => 'Vui lòng nhập đúng đường link instagram.',

            ]
        );

        $vendor = Vendor::where("user_id", Auth::user()->id)->first();

        // Handle file image update
        $image_path = $this->updateImage($request, 'banner', 'uploads/vendor', 250, 250, $vendor->banner);

        $vendor->banner = !empty($image_path) ? $image_path : $vendor->banner;
        $vendor->shop_name = $request->shop_name;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->description = $request->description;

        $vendor->facebook_link = $request->facebook_link;
        $vendor->youtube_link = $request->youtube_link;
        $vendor->instagram_link = $request->instagram_link;
        $vendor->status = 1;
        $vendor->save();

        toastr()->success('Cập nhật thành công!', ' ');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
