<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $rooms = ChatRoom::with(['user', 'latestMessage'])
            ->withCount(['unreadByAdmin as unread_count'])
            ->orderByDesc('last_message_at')
            ->paginate(20);

        return view('admin.chats.index', compact('rooms'));
    }

    public function show(ChatRoom $chatRoom)
    {
        $chatRoom->load(['user', 'messages.sender']);

        // Mark all customer messages as read
        $chatRoom->messages()
            ->where('sender_type', 'customer')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('admin.chats.show', compact('chatRoom'));
    }

    public function send(Request $request, ChatRoom $chatRoom)
    {
        $request->validate(['body' => 'required|string|max:2000']);

        $message = ChatMessage::create([
            'chat_room_id' => $chatRoom->id,
            'sender_type'  => 'admin',
            'sender_id'    => Auth::id(),
            'body'         => $request->body,
        ]);

        $chatRoom->update(['last_message_at' => now()]);

        return response()->json([
            'id'          => $message->id,
            'body'        => $message->body,
            'sender_type' => 'admin',
            'time'        => $message->created_at->format('H:i'),
            'date'        => $message->created_at->format('d M Y'),
        ]);
    }

    public function poll(Request $request, ChatRoom $chatRoom)
    {
        $sinceId = (int) $request->query('since', 0);

        $messages = $chatRoom->messages()
            ->where('id', '>', $sinceId)
            ->get()
            ->map(fn($m) => [
                'id'          => $m->id,
                'body'        => $m->body,
                'sender_type' => $m->sender_type,
                'time'        => $m->created_at->format('H:i'),
                'date'        => $m->created_at->format('d M Y'),
            ]);

        // Mark incoming customer messages as read
        $chatRoom->messages()
            ->where('sender_type', 'customer')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json($messages);
    }
}
