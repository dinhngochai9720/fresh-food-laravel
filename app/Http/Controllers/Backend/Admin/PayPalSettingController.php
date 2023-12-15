<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;

class PayPalSettingController extends Controller
{
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'status' => ['required'],
                'account_mode' => ['required', 'integer'],
                'country_name' => ['required'],
                'currency_name' => ['required'],
                'currency_rate' => ['required'],
                'client_id' => ['required'],
                'secret_key' => ['required'],
            ],
            [
                'status.required' => 'Vui lòng chọn trạng thái thanh toán.',
                'account_mode.required' => 'Vui lòng chọn chế độ tài khoản.',
                'country_name.required' => 'Vui lòng chọn quốc gia.',
                'currency_name.required' => 'Vui lòng chọn tiền tệ.',
                'currency_rate.required' => 'Vui lòng nhập tỷ giá tiền tệ.',
                'client_id.required' => 'Vui lòng nhập Paypal Client ID.',
                'secret_key.required' => 'Vui lòng nhập Paypal Secret Key.',
            ]
        );

        PaypalSetting::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'status' => $request->status,
                'account_mode' => $request->account_mode,
                'country_name' => $request->country_name,
                'currency_name' => $request->currency_name,
                'currency_rate' => $request->currency_rate,
                'client_id' => $request->client_id,
                'secret_key' => $request->secret_key,
            ]
        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }
}
