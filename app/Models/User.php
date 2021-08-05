<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject {
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_type_id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = ['deleted_at'];

    public function userType() {
        return $this->hasOne(UserType::class, 'id', 'user_type_id');
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function message() {
        return $this->hasMany(Message::class, 'user_id', 'id');
    }

    public function userChat() {
        return $this->hasMany(UserChat::class, 'user_id', 'id');
    }
}
