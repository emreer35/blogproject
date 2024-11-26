<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function VerificationPrompt(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/');
        } else {
            return redirect()->route('profile.edit')->with('status', 'verification-notification');
        }
    }
    public function verifyHandler(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('profile.edit') . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->route('profile.edit')->with('status', 'verified-email');
    }

    public function verificationNotification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('profile.edit');
        }
        $request->user()->sendEmailVerificationNotification();

        return back()->with([
            'status' => 'verification-send-email'
        ]);
    }
}
