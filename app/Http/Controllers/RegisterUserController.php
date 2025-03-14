<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;


class RegisterUserController extends Controller
{
    public function create(): View
    {
        return view('register');
    }

    public function store(Request $request): RedirectResponse
    {
        $userAttributes = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
            'password_confirmation' => 'required'
        ]);

        $user = User::create($userAttributes);

        Auth::login($user);

        return redirect('/');
    }

    public function telegramView(): RedirectResponse
    {
        $telegramLink = 'https://t.me/laravel2FABot';
        return redirect()->intended($telegramLink);
        //return view('telegram', compact('telegramLink'));
    }

}
