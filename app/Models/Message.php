<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = "message";
    protected $fillable = [
        'chat_id', 'user_id', 'text'
    ];

    public function chat() {
        return $this->belongsTo(Chat::class, 'chat_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
