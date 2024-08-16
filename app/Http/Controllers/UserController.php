<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // عرض نموذج التسجيل  
    public function showRegistrationForm()
    {
        return view('site.layouts.register');
    }


    public function register(Request $request)
    {

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // إنشاء المستخدم  
        $user = User::factory()->create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'remember_token' => Str::random(60),
        ]);

        // تجديد الجلسة  
        session()->regenerate();

        // تعيين المستخدم كمستخدم مسجل دخول  
        Auth::login($user);

        return redirect('/');
    }





    public function showLoginForm()
    {
        return view('site.layouts.login');
    }



    // تسجيل الدخول  
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/'); 
        }

        return back()->withErrors(['email' => 'البريد الإلكتروني أو كلمة المرور هاطئة.']);
    }

    // تسجيل الخروج  
    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');  
    }
}
