<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['chat_room_id', 'sender_type', 'sender_id', 'body', 'read_at'];
    protected $casts    = ['read_at' => 'datetime'];

    public function room()   { return $this->belongsTo(ChatRoom::class, 'chat_room_id'); }
    public function sender() { return $this->belongsTo(User::class, 'sender_id'); }

    public function isFromAdmin()    { return $this->sender_type === 'admin'; }
    public function isFromCustomer() { return $this->sender_type === 'customer'; }
}
