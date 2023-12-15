<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Newsletter;
use App\Helper\MailHelper;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = NewsletterSubscriber::orderBy('id', 'DESC')->get();
        return view('admin.subscriber.index', compact('subscribers'));
    }

    public function sendMail(Request $request)
    {
        $request->validate(
            [
                'subject' => ['required'],
                'content' => ['required'],

            ],
            [
                'subject.required' => 'Vui lòng nhập chủ đề.',
                'content.required' => 'Vui lòng nhập nội dung.',
            ]
        );

        $emails = NewsletterSubscriber::where('is_verified', 1)->pluck('email')->toArray();


        // set mail config
        MailHelper::setMailConfig();
        Mail::to($emails)->send(new Newsletter($request->subject, $request->content));
        toastr()->success('Đã gửi email thành công!', ' ');
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);

        $subscriber->delete();
        return response(['status' => 'success', 'message' => 'Xóa thành công dữ liệu']);
    }
}
