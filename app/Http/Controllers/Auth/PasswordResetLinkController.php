<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $email = $request->email;
        $otp = random_int(100000, 999999);

        // Store OTP in database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $otp, // Overriding default string token with OTP
                'created_at' => now()
            ]
        );

        // Send actual email using Gmail SMTP
        \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\OtpMail($otp));

        return redirect()->route('password.verify')->with([
            'status' => "We have dispatched a 6-digit OTP to your email address.",
            'reset_email' => $email
        ]);
    }
}
