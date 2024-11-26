<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validateWithBag('password_update', [
            'current_password' => ['string', 'current_password', 'required'],
            'password' => ['required', Password::defaults(), 'confirmed']
        ], [
            'current_password.required' => 'Mevcut şifre alanı zorunludur.',
            'current_password.current_password' => 'Girdiğiniz mevcut şifre hatalıdır.',
            'password.required' => 'Yeni şifre alanı zorunludur.',
            'password.confirmed' => 'Yeni şifreler eşleşmiyor.',
            'password.min' => 'Şifre en az 6 karakter olmalıdır.',
        ]);
        $request->user()->update([
            'password' => Hash::make($validate['password'])
        ]);

        return back()->with('success', 'Şifreniz Güncellendi.');
    }
}
