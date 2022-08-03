<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, Password};
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));

        return redirect()->route('home')
            ->with('toast_success', 'Verification link is sent to your mail!');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (is_null($user->email_verified_at)) {
            return back()->with('email-verification-sending-link', route('verification.send', [$user->id]));
        }

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            $error = 'The provided credentials do not match our records.';
            return back()->with('toast_error', 'The provided credentials do not match our records.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('toast_success', 'Login successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function forgot_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('toast_success', __($status))
            : back()->with('toast_error', __($status));
    }

    public function reset_password(Request $request, $token = null)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $status = Password::reset($request->only('email', 'password', 'password', 'token'), function (
            $user,
            $password
        ) {
            $user
                ->forceFill([
                    'password' => Hash::make($password),
                ])
                ->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        return $status === Password::PASSWORD_RESET
            ? redirect()
            ->route('login')
            ->with('toast_success', __($status))
            : back()->with('toast_error', __($status));
    }

    public function verify_email(EmailVerificationRequest $request)
    {
        $request->fulfill();
        Auth::loginUsingId($request->id);

        return redirect()->route('home')->with('toast_success', 'Email Verified!');
    }

    public function resend_verification_email(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $user->sendEmailVerificationNotification();

        return back()->with('toast_info', 'Verification link sent!');
    }
}
