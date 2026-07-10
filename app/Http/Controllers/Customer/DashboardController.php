<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $room = ChatRoom::firstOrCreate(['user_id' => $user->id]);
        $room->load('messages');

        // Mark all admin messages as read
        $room->messages()
            ->where('sender_type', 'admin')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('customer.dashboard', compact('user', 'room'));
    }
}
