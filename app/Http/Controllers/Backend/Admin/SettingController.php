<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailConfigSetting;
use App\Models\GeneralSetting;
use App\Models\PaypalSetting;
use App\Models\StripeSetting;
use App\Models\VNPaySetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $paypal_setting = PaypalSetting::first();
        $stripe_setting = StripeSetting::first();
        $general_setting = GeneralSetting::first();
        $vnpay_setting = VNPaySetting::first();
        $email_config_setting = EmailConfigSetting::first();
        return view('admin.setting.index', compact('general_setting', 'paypal_setting', 'stripe_setting', 'vnpay_setting', 'email_config_setting'));
    }
}
