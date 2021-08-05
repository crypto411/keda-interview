<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use App\Models\UserChat;
use Illuminate\Http\Request;

class MessageController extends Controller {
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function getOwnChat() {
        $user = auth()->user();
        $chats = $user->userChat->map(function ($item, $key) {
            $chat = Chat::find($item->chat_id);
            return collect($chat);
        });
        return response()->json(['chats' => $chats]);
    }

    public function getAllChat() {
        $chats = Chat::all();
        return response()->json(['chats' => $chats]);
    }

    public function send(Request $request) {
        $validator = \Validator::make($request->all(), [
            'chat_id' => 'required|integer',
            'to_user_id' => 'required|integer|exists:users,id',
            'text' => 'required|string'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = auth()->user();
        $to_user = User::find($request->to_user_id);

        if($to_user->userType->id > $user->userType->id) {
            return $this->unauthorized();
        }

        $chat = Chat::find($request->chat_id);
        if(!$chat) {
            $chat = Chat::createChat([$user->id, $request->to_user_id]);
        }
        $message = Message::create([
            'chat_id'   => $chat->id,
            'user_id'   => $user->id,
            'text'      => $request->text
        ]);

        return response()->json([
            "success" => "Message sent successfully",
            "message" => $message
        ]);
    }
}
