<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        return view('profile', ['user' => $request->user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'current_password' => ['nullable', 'string'],
            'new_password' => ['nullable', 'string', 'min:6'],
            'confirm_password' => ['nullable', 'same:new_password'],
        ], [
            'confirm_password.same' => 'Password baru tidak cocok!',
            'new_password.min' => 'Password baru minimal 6 karakter!',
        ]);

        if (! empty($validated['new_password'])) {
            if (! Hash::check($request->input('current_password'), $user->password)) {
                return back()->with('error', 'Password saat ini salah!');
            }

            $user->password = Hash::make($validated['new_password']);
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return back()->with('success', 'Profile berhasil diperbarui!');
    }
}
