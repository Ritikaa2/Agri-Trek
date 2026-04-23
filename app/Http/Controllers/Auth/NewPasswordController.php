<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the OTP verification and new password view.
     */
    public function create(Request $request): View
    {
        return view('auth.verify-otp', [
            'email' => session('reset_email', $request->email)
        ]);
    }

    /**
     * Handle an incoming OTP verification and reset password.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'otp' => ['required', 'numeric', 'digits:6'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $resetRequest = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$resetRequest || $resetRequest->token !== $request->otp) {
            return back()->withErrors(['otp' => 'The provided OTP is invalid or has expired.'])->withInput($request->only('email'));
        }

        // Successfully verified OTP, update password
        $user = User::where('email', $request->email)->first();
        $user->forceFill([
            'password' => Hash::make($request->password)
        ])->save();

        // Delete the OTP token so it can't be reused
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Your password has been successfully reset using OTP!');
    }
}
