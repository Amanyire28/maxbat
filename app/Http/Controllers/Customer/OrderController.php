<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /** Place an order from the cart */
    public function store(Request $request)
    {
        $request->validate([
            'items'       => 'required|array|min:1',
            'items.*.id'  => 'required|integer',
            'items.*.name'=> 'required|string',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'total'       => 'required|numeric|min:0',
            'notes'       => 'nullable|string|max:500',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'items'   => $request->items,
            'total'   => $request->total,
            'notes'   => $request->notes,
            'status'  => 'pending',
        ]);

        return response()->json([
            'success'  => true,
            'order_id' => $order->id,
            'message'  => 'Order #'.$order->id.' placed successfully! Our team will contact you to confirm.',
        ]);
    }

    /** List orders for the logged-in user */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return response()->json($orders);
    }
}
