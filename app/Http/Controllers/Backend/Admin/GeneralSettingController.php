<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use App\Traits\HandlerImage;


class GeneralSettingController extends Controller
{

    use HandlerImage;
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'site_name' => ['required'],
                'logo' => ['image'],
                'logo_footer' => ['image'],
                'favicon_icon' => ['image'],
                'email_contact' => ['required', 'email'],
                'phone_contact' => ['required'],
                'address' => ['required'],
                'facebook_link' => ['nullable', 'url'],
                'youtube_link' => ['nullable', 'url'],
                'instagram_link' => ['nullable', 'url'],
                'currency_name' => ['required'],
                'currency_icon' => ['required'],
                'time_zone' => ['required'],
                'copyright' => ['required'],
            ],
            [
                'site_name.required' => 'Vui lòng nhập tên website.',
                'logo.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'logo_footer.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',
                'favicon_icon.image' => 'Vui lòng chọn lại đúng định dạng file ảnh.',

                'email_contact.required' => 'Vui lòng nhập email liên hệ.',
                'email_contact.email' => 'Vui lòng nhập đúng định dạng email.',
                'phone_contact.required' => 'Vui lòng nhập tổng đài liên hệ.',
                'address.required' => 'Vui lòng nhập địa chỉ.',

                'facebook_link.url' => 'Vui lòng nhập đúng đường link.',
                'youtube_link.url' => 'Vui lòng nhập đúng đường link.',
                'instagram_link.url' => 'Vui lòng nhập đúng đường link.',

                'currency_name.required' => 'Vui lòng chọn đơn vị tiền tệ.',
                'currency_icon.required' => 'Vui lòng nhập ký hiệu đơn vị tiền tệ.',
                'time_zone.required' => 'Vui lòng chọn múi giờ.',
                'copyright.required' => 'Vui lòng nhập copyright.',

            ]
        );

        $general_setting = GeneralSetting::find($id);

        // Handle file image upload
        $logo_image_path = $this->updateImage($request, 'logo', 'uploads/logo', 147, 51, $general_setting?->logo);
        $logo_footer_image_path = $this->updateImage($request, 'logo_footer', 'uploads/logo', 160, 56, $general_setting?->logo_footer);
        $favicon_icon_image_path = $this->updateImage($request, 'favicon_icon', 'uploads/logo', 112, 112, $general_setting?->favicon_icon);

        GeneralSetting::updateOrCreate(
            ['id' => $id],
            [
                'site_name' => $request->site_name,
                'logo' => !empty($logo_image_path) ? $logo_image_path : $general_setting->logo,
                'logo_footer' => !empty($logo_footer_image_path) ? $logo_footer_image_path : $general_setting->logo_footer,
                'favicon_icon' => !empty($favicon_icon_image_path) ? $favicon_icon_image_path : $general_setting->favicon_icon,

                'email_contact' => $request->email_contact,
                'phone_contact' => $request->phone_contact,
                'address' => $request->address,

                'facebook_link' => $request->facebook_link,
                'youtube_link' => $request->youtube_link,
                'instagram_link' => $request->instagram_link,

                'currency_name' => $request->currency_name,
                'currency_icon' => $request->currency_icon,
                'time_zone' => $request->time_zone,

                'copyright' => $request->copyright,

            ]
        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }
}
