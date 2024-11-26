<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6'
            ],
            [
                'name.required' => 'Adınız alanı zorunludur.',
                'name.string' => 'Lütfen sadece metin kullanınız.',
                'name.max' => 'Adınız en fazla 255 karakterden olmalıdır.',
                'email.required' => 'Email alanı zorunludur.',
                'email.email' => 'Lütfen geçerli bir e-posta adresi giriniz.',
                'email.unique' => 'Bu e-posta adresi zaten kayıtlı. Lütfen başka bir e-posta adresi giriniz.',
                'password.required' => 'Şifre alanı zorunludur.',
                'password.min' => 'Şifreniz en az 6 karakter olmalıdır.'
            ]
        );
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        event(new Registered($user));
        $user->sendEmailVerificationNotification();
        Auth::login($user);
        return redirect()->intended()->with(['success' => 'Kayıt Başarılı. Yönlendirme Aktif']);
    }
}
