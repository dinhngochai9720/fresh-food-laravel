<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailConfigSetting;
use Illuminate\Http\Request;

class EmailConfigSettingController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'email' => ['required', 'email'],
                'mail_host' => ['required'],
                'username_smtp' => ['required'],
                'password_smtp' => ['required'],
                'mail_port' => ['required'],
                'mail_encryption' => ['required'],
            ],
            [
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Vui lòng nhập đúng định dạng email.',
                'mail_host.required' => 'Vui lòng nhập mail host.',
                'username_smtp.required' => 'Vui lòng nhập tên smtp.',
                'password_smtp.required' => 'Vui lòng nhập mật khẩu smtp.',
                'mail_port.required' => 'Vui lòng nhập mail port.',
                'mail_encryption.required' => 'Vui lòng nhập mail encryption.',

            ]
        );

        EmailConfigSetting::updateOrCreate(
            ['id' => $id],
            [
                'email' => $request->email,
                'mail_host' => $request->mail_host,
                'username_smtp' => $request->username_smtp,
                'password_smtp' => $request->password_smtp,
                'mail_port' => $request->mail_port,
                'mail_encryption' => $request->mail_encryption,
            ]
        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }
}
