<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        return view('message/sendMesssage', ['user' => $user]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'user_id' => 'required|numeric|exists:users,id'
        ]);

        Message::create([
            'content' => $request->content,
            'user_id' => $request->user_id,
        ]);
        $request->session()->flash('message_sent', 'message sent successfully');
        return redirect(url("user/$request->user_id"));
    }
    public function delete($userId, $msgId)
    {
        // check if target message belongs to that current_user or not  
        $message = Message::where('id', '=', $msgId)->where('user_id', '=', $userId)->first();
        if ($message == null) {
            return back();
        }
        $message->delete();
        return back();
    }
}