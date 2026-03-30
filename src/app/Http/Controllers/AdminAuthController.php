<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session('is_admin')) {
            return redirect()->route('admin.index');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ], [
            'password.required' => 'パスワードを入力してください。',
        ]);

        $correct = hash_equals(
            config('app.admin_password'),
            $request->input('password')
        );

        if (! $correct) {
            return back()->withErrors(['password' => 'パスワードが正しくありません。']);
        }

        $request->session()->regenerate();
        session(['is_admin' => true]);

        return redirect()->route('admin.index');
    }

    public function logout(Request $request)
    {
        session()->forget('is_admin');
        $request->session()->regenerate();

        return redirect()->route('money-records.index')
            ->with('success', 'ログアウトしました。');
    }
}
