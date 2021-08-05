<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = "chat";
    protected $fillable = [
        'name'
    ];

    public function message() {
        return $this->hasMany(Message::class, 'chat_id', 'id');
    }

    public function userChat() {
        return $this->hasOne(UserChat::class, 'chat_id', 'id');
    }

    public static function createChat($participants_user_id) {
        $chat = Chat::create([
            'name' => 'chat-'. \Str::random(16)
        ]);

        foreach($participants_user_id as $user_id) {
            $userChat = UserChat::create([
                'user_id' => $user_id,
                'chat_id' => $chat->id
            ]);
        }
        return $chat;
    }
}
