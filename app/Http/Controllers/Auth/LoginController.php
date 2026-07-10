<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('customer.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                if ($request->wantsJson()) {
                    return response()->json(['success' => true, 'redirect' => route('admin.dashboard')]);
                }
                return redirect()->route('admin.dashboard');
            }

            if ($request->wantsJson()) {
                return response()->json(['success' => true]);
            }
            return redirect()->route('customer.dashboard');
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => false, 'message' => 'Invalid email or password.'], 422);
        }

        return back()
            ->withErrors(['email' => 'Invalid email or password.'])
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
