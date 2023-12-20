<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['seen'];

    public function receiverProfile()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function senderProfile()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
