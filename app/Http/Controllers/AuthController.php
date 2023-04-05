<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect(route('user.profile'));
        }

        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string'
        ]);

        if ($validate->fails())
            return redirect(route('user.registration'))->withErrors($validate->errors());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => 0,
            'password' => Hash::make($request->password)
        ]);

        if ($user) {
            Auth::login($user);
            return redirect()->to(route('user.profile'));
        }

        return redirect()->to(route('user.profile'))->withErrors([
            'formError' => 'Произошла ошибка при сохранении пользователя'
        ]);
    }
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect(route('user.profile'));
        }
        $formFields = $request->only(['email', 'password']);

        if (Auth::attempt($formFields)) {
            return redirect(route('user.profile'));
        }
        return redirect(route('user.login'))->withErrors([
            'email' => 'Не удалось авторизоваться'
        ]);
    }
    public function profile(Request $request)
    {
        if (Auth::user()->role_id == 0) {
            return view('captcha');
        }
        return view('profile');
    }
}
