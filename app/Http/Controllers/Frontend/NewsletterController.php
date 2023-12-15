<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\VerificationSubscriber;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Str;

class NewsletterController extends Controller
{
    public function newsletterRequest(Request $request)
    {
        $request->validate(
            [
                'email' => ['required', 'email'],
            ],
            [
                'email.required' => 'Vui lòng nhập email của bạn.',
                'email.email' => 'Vui lòng nhập đúng định dạng email.',
            ]
        );

        $exist_subscriber = NewsletterSubscriber::where('email', $request->email)->first();

        // exist subscriber
        if ($exist_subscriber) {
            if ($exist_subscriber->is_verified == 0) {
                //send notification to email subscriber
                return response(['status' => 'warning', 'message' => "Email đã đăng ký! Vui lòng xác nhận email."]);
            } else if ($exist_subscriber->is_verified == 1) {
                return response(['status' => 'error', 'message' => "Email đã được đăng ký."]);
            }
        } else {
            $subscriber = new NewsletterSubscriber();
            $subscriber->email = $request->email;
            $subscriber->verified_token = Str::random(25);
            $subscriber->is_verified = 0;
            $subscriber->save();

            // set mail config
            MailHelper::setMailConfig();

            Mail::to($subscriber->email)->send(new VerificationSubscriber($subscriber));

            return response(['status' => 'success', 'message' => "Link xác nhận đã được gửi đến email của bạn."]);
        }
    }

    public function newsletterEmailVerify($token)
    {
        $verify = NewsletterSubscriber::where('verified_token', $token)->first();

        if ($verify) {
            $verify->verified_token = 'verified';
            $verify->is_verified = 1;
            $verify->save();

            toastr()->success('Xác nhận email thành công', ' ');
            return redirect()->route('home');
        } else {
            toastr()->error('Xác nhận email thất bại', ' ');
            return redirect()->route('home');
        }
    }
}
