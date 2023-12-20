<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $senders_info = Message::with(['senderProfile'])
            ->where('receiver_id', Auth::user()->id)
            ->where('sender_id', '!=', Auth::user()->id)
            ->select(['sender_id'])
            ->groupBy('sender_id')
            ->get();

        return view('vendor.message.index', compact('senders_info'));
    }

    public function getMessage(Request $request)
    {
        $receiver_id = Auth::user()->id;
        $sender_id = $request->sender_id;

        // get all messages in chat between 2 difference users (do not get messages user send user)
        $messages = Message::where(function ($query) use ($sender_id, $receiver_id) {
            $query
                ->where('receiver_id', $sender_id)
                ->where('sender_id', $receiver_id);
        })->orWhere(function ($query) use ($sender_id, $receiver_id) {
            $query
                ->where('receiver_id', $receiver_id)
                ->where('sender_id', $sender_id);
        })->get();

        // update status message from unseen to seen
        Message::where(['sender_id' => $sender_id, 'receiver_id' => $receiver_id])->update(['seen' => 1]);

        return response($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => ['required'],
        ], [
            'message.required' => 'Vui lòng nhập tin nhắn.',
        ]);

        $message = new Message();
        $message->sender_id = Auth::user()->id;
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        broadcast(new MessageEvent($message->message, $message->receiver_id, $message->created_at));

        return response(['status' => 'success', 'message' => 'Đã gửi tin nhắn!']);
    }
}
