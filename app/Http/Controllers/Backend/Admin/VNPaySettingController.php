<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\VNPaySetting;
use Illuminate\Http\Request;

class VNPaySettingController extends Controller
{
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'status' => ['required'],
                'tmncode' => ['required'],
                'hashsecret' => ['required'],
                'url' => ['required'],
            ],
            [
                'status.required' => 'Vui lòng chọn trạng thái thanh toán.',
                'tmncode.required' => 'Vui lòng nhập VNPay TMNCODE.',
                'hashsecret.required' => 'Vui lòng nhập VNPay HASHSECRET.',
                'url.required' => 'Vui lòng nhập VNPay URL.',
            ]
        );

        VNPaySetting::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'status' => $request->status,
                'tmncode' => $request->tmncode,
                'hashsecret' => $request->hashsecret,
                'url' => $request->url,
            ]
        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }
}
