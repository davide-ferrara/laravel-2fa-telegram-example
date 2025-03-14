<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create(): View
    {
        return view('login');
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();

        return redirect('/');
    }

    public function twoFactorAuthView(): View
    {
        return view('two-factor-auth');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // If user has 2FA we send the OTP
        if (TelegramController::isTwoFactorEnabled($credentials['email'])) {
            $otp = TelegramController::sendOtp($credentials['email']);
            session(['otp' => $otp, 'email' => $credentials['email']]);

            // OTP page
            return redirect()->intended('/login/2fa');
        } else {
            // Else we log in without it
            if (!Auth::attempt($credentials)) {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ])->onlyInput('email');
            }
            $request->session()->regenerate();
            return redirect('/');
        }
    }

    public function verifyOTP(Request $request): RedirectResponse
    {
        Log::debug("Verifying OTP code");
        $attributes = request()->validate([
            'otp' => ['required', 'numeric', 'digits:6'],
        ]);

        Log::debug($attributes['otp'] . ' ' . session('otp'));

        if ($request->otp != session('otp')) {
            return back()->withErrors(['otp' => 'Invalid OTP code.']);
        }

        $email = session('email');
        $user = DB::table('users')->where('email', $email)->first();
        Auth::loginUsingId($user->id);

        session()->forget(['otp', 'email']);
        return redirect('/');
    }
}
