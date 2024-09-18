<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt($request->only('email', 'password'))) {
            // Điều hướng đến trang chủ sau khi đăng nhập thành công
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }

        // Quay lại trang đăng nhập nếu thất bại
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->withInput($request->only('email'));
    }

    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('admin');
        // Đăng nhập người dùng sau khi đăng ký
        Auth::login($user);

        // Điều hướng tới trang chủ sau khi đăng ký thành công
        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();
        //Tìm hoặc tạo người dùng mới
        $user = User::firstOrCreate([
            'email' => $socialUser->getEmail(),
        ], [
            'name' => $socialUser->getName(),
            'provider' => 'google',
            'provider_id' => $socialUser->getId(),
            'avatar' => $socialUser->getAvatar(),
            'password' => Hash::make(Str::password(24)),
        ]);

        // Đăng nhập người dùng
        Auth::login($user, true);
        return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
    }
}

