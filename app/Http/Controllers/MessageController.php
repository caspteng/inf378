<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function show(User $user)
    {
        $messages = Message::with('sender')
            ->where('receiver_id', auth()->user()->id)
            ->where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->where('sender_id', auth()->user()->id)->get();
        return view('messages')
            ->with('user', $user)
            ->with('messages', $messages);
    }

    public function store(User $user)
    {
        $attribute = request()->validate([
            'message' => 'required'
        ]);
        auth()->user()->sendMessageTo($user->id, $attribute['message']);
        return back();
    }
}
