<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $fillable = ['user_id', 'last_message_at'];
    protected $casts = ['last_message_at' => 'datetime'];

    public function user()     { return $this->belongsTo(User::class); }
    public function messages() { return $this->hasMany(ChatMessage::class)->orderBy('created_at'); }

    public function latestMessage()
    {
        return $this->hasOne(ChatMessage::class)->latestOfMany();
    }

    public function unreadByAdmin()
    {
        return $this->messages()->where('sender_type', 'customer')->whereNull('read_at');
    }
}
