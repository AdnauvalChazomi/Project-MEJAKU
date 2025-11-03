<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\FotoMenu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileOwnerController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = auth()->user();
        $owner = $user->owner;
        $fotoMenus = FotoMenu::where('owner_id', $owner->id)->get();

        return view('owner.profile.edit', [
            'user' => $user,
            'owner' => $owner,
            'fotoMenus' => $fotoMenus,
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

        return Redirect::route('owner.profile.edit')->with('status', 'profile-updated');
    }

    public function uploadFoto(Request $request)
    {
        $user = auth()->user();
        $owner = $user->owner;

        $validated = $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('foto')->store('foto_menu', 'public');

        FotoMenu::create([
            'owner_id' => $owner->id,
            'url' => $path,
        ]);

        return back()->with('success', 'Foto menu berhasil diunggah!');
    }

    public function destroyFoto($id)
    {
        $foto = FotoMenu::findOrFail($id);

        if ($foto->url && Storage::disk('public')->exists($foto->url)) {
            Storage::disk('public')->delete($foto->url);
        }

        $foto->delete();

        return back()->with('success', 'Foto menu berhasil dihapus!');
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
