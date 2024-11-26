<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $perPage = $request->input('per_page', '10');
        $sortBy = $request->input('sort_by', 'id'); // default asc
        $sortDirection = $request->input('sort_direction', 'asc');


        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sortDirection)
            ->paginate($perPage)->appends([
                'search' => $search,
                'sort_by' => $sortBy,
                'sort_direction' => $sortDirection,
                'per_page' => $perPage
            ]);



        return view(
            'admin.user.index',
            [
                'users' => $users,
                'search' => $search,
                'sortBy' => $sortBy,
                'sortDirection' => $sortDirection,
                'perPage' => $perPage
            ]
        );
    }

    public function updateRole(Request $request, $id)
    {


        $user = User::findOrFail($id);
        if ($user->id === Auth::user()->id) {
            return redirect()->back()->with('success', 'Kendi Rolünüzü Güncelleyemezsiniz.');
        }

        $request->validate([
            'role' => 'required|in:admin,user'
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Rol Başarıyla Güncellendi.');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'new_password' => 'sometimes|min:6',

        ], [
            'name.max' => 'Ad en fazla 255 karakter olabilir.',
            'email.email' => 'Geçerli bir e-posta adresi girin.',
            'email.unique' => 'Bu e-posta adresi zaten kullanımda.',
            'new_password.min' => 'Şifre en az 6 karakter olmalıdır.'
        ]);



        if (Auth::user()->id === $user->id) {
            return redirect()->back()->with('success', 'Kendi Profilinizi Güncelleyemezsiniz.');
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        if ($request->filled('new_password')) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
        }


        return redirect()->back()->with('success', 'Kullanıcı Başarıyla Güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->id === $user->id) {
            return back()->with('success', 'Kendi Hesabınızı Profil Bölümünden Siliniz.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'Kullanıcı Başarıyla Silindi.');
    }
}
