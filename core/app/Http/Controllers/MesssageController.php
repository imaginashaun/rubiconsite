<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Conversation;
use App\Message;

class MesssageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|max:500',
            'receiver_id' => 'required|exists:users,id',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:100000'
        ]);
        $user = Auth::user();
        if($user->id != $request->recevier_id)
        {
            $conversion = new Conversation();
            $conversion->sender_id = $user->id;
            $conversion->receiver_id = $request->receiver_id;
            $conversion->save();

            $message = new Message();
            $message->conversion_id = $conversion->id;
            $message->sender_id = $user->id;
            $message->receiver_id = $request->receiver_id;
            $message->message = $request->message;
            $message->save();
            $notify[] = ['success', 'Message Sent'];
            return back()->withNotify($notify);
        }
        $notify[] = ['error', "it's You"];
        return back()->withNotify($notify);
    }

    public function inbox()
    {
        $user = Auth::user();
        $page_title = "Inbox List";
        $conversions = Conversation::where('sender_id', $user->id)->orWhere('receiver_id', $user->id)->latest()->get();
        return view(activeTemplate() . 'inbox', compact('page_title', 'conversions'));
    }

    public function chat($conversion_id)
    {
       $page_title = 'Message Box';
       $messages = Message::where('conversion_id',$conversion_id)->get();
       return view(activeTemplate() . 'message', compact('page_title','messages','conversion_id'));
    }

    public function messageStore(Request $request)
    {
        $request->validate([
            'message' => 'required|max:500',
            'conversion_id' => 'required|exists:conversations,id',
            'receiver_id' => 'required|exists:users,id',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:100000'
        ]);
        $message = new Message();
        $path = imagePath()['message']['path'];
        $size = imagePath()['message']['size'];
        if($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $message->file = $filename;
        }
        $message->conversion_id = $request->conversion_id;
        $message->sender_id = auth()->user()->id;
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();
        $notify[] = ['success', 'Message Sent'];
        return back()->withNotify($notify);
    }

}
