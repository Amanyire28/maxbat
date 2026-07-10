<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        if (Auth::check() && !Auth::user()->isAdmin()) {
            return redirect()->route('customer.dashboard');
        }
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'customer',
        ]);

        ChatRoom::create(['user_id' => $user->id]);
        Auth::login($user);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'redirect' => route('customer.dashboard')]);
        }

        return redirect()->route('customer.dashboard')
            ->with('success', 'Welcome to MaxBat! Your account has been created.');
    }
}
