<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /** Send a message from customer */
    public function send(Request $request)
    {
        $request->validate(['body' => 'required|string|max:2000']);

        $user = Auth::user();
        $room = ChatRoom::firstOrCreate(['user_id' => $user->id]);

        $message = ChatMessage::create([
            'chat_room_id' => $room->id,
            'sender_type'  => 'customer',
            'sender_id'    => $user->id,
            'body'         => $request->body,
        ]);

        $room->update(['last_message_at' => now()]);

        return response()->json([
            'id'          => $message->id,
            'body'        => $message->body,
            'sender_type' => 'customer',
            'time'        => $message->created_at->format('H:i'),
            'date'        => $message->created_at->format('d M Y'),
        ]);
    }

    /** Poll for new messages since a given ID */
    public function poll(Request $request)
    {
        $user    = Auth::user();
        $room    = ChatRoom::firstOrCreate(['user_id' => $user->id]);
        $sinceId = (int) $request->query('since', 0);

        $messages = $room->messages()
            ->where('id', '>', $sinceId)
            ->get()
            ->map(fn($m) => [
                'id'          => $m->id,
                'body'        => $m->body,
                'sender_type' => $m->sender_type,
                'time'        => $m->created_at->format('H:i'),
                'date'        => $m->created_at->format('d M Y'),
            ]);

        // Mark incoming admin messages as read
        $room->messages()
            ->where('sender_type', 'admin')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json($messages);
    }
}
