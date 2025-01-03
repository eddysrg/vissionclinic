<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        /* $image = $request->file('profile_image');

        $fileName = 'profile_' . Str::uuid() . '.' . $image->extension();

        $path = $image->store('profiles', $fileName);

        $imageUrl = Storage::url($path);

        $user = $request->user();
        $user->profile_photo = $imageUrl;
        $user->save(); */

        $extension = $request->file('profile_image')->extension();

        $fileName = 'profile_' . Str::uuid() . '.' . $extension;

        $path = $request->file('profile_image')->storeAs('profiles', $fileName, 'public');

        $user = $request->user();
        $user->profile_photo = $path;
        $user->save();

        return response()->json(['message' => 'Imagen subida correctamente', 'image_url' => $path]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
