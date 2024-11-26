<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{

    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user()
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();
        return redirect()->route('profile.edit')->with(['success' => 'Profil Güncellendi.']);
    }

    public function imageUpdate(Request $request)
    {
        $request->validateWithBag('change_profile_image', [
            'image' => 'required|mimes:png,jpg,jpeg,svg'
        ], [
            'image.mimes' => 'Görüntü alanı şu türde bir dosya olmalıdır: png, jpg, jpeg, svg.',
            'image.required' => 'Lütfen bir fotoğraf seçiniz.'
        ]);

        $user = Auth::user();

        if ($user->image && $user->image !== 'user.png' && File::exists(public_path('assets/image/user/' . $user->image))) {
            File::delete(public_path('assets/image/user/' . $user->image));
        }

        if ($request->hasFile('image')) {


            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'assets/image/user/';
            $image->move(public_path($imagePath), $imageName);

            $user->image = $imageName;
            $user->save();
        }

        return back()->with('success', 'Profil Fotoğrafı Değiştirildi.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => [
                'required',
                'current_password'
            ]
        ]);
        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
