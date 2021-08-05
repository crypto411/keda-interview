<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChat extends Model
{
    use HasFactory;

    protected $table = "user_chat";
    protected $fillable = [
        'chat_id', 'user_id'
    ];
    public $timestamps = false;
    public $incrementing = false;

    public function chat() {
        return $this->belongsTo(Chat::class, 'chat_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
