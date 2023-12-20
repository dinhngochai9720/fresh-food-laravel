<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\PusherSetting;
use Illuminate\Http\Request;

class PusherSettingController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'app_id' => ['required'],
                'key' => ['required'],
                'secret' => ['required'],
                'cluster' => ['required'],

            ],
            [
                'app_id.required' => 'Vui lòng nhập App ID.',
                'key.required' => 'Vui lòng nhập Key.',
                'secret.required' => 'Vui lòng nhập Secret.',
                'cluster.required' => 'Vui lòng nhập Cluster.',
            ]
        );

        PusherSetting::updateOrCreate(
            ['id' => $id],
            [
                'app_id' => $request->app_id,
                'key' => $request->key,
                'secret' => $request->secret,
                'cluster' => $request->cluster,
            ]
        );

        toastr()->success('Cập nhật thành công!', ' ');
        return redirect()->back();
    }
}
