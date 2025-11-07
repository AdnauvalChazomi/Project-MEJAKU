<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\FotoMenu;
use App\Models\Menu;
use App\Models\MenuUnggulan;
use App\Models\Operational;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RestoranController extends Controller
{
    public function edit(Request $request): View
    {
        $user = auth()->user();
        $owner = $user->owner;

        $fotoMenus = FotoMenu::where('owner_id', $owner->id)->get();

        $reviews = Review::where('owner_id', $owner->id)
            ->with('user')
            ->latest()
            ->get();

        $menuUnggulan = MenuUnggulan::with('menu')
            ->where('owner_id', $owner->id)
            ->orderBy('id')
            ->get();

        $menus = Menu::where('owner_id', $owner->id)->get();

        $operationals = Operational::where('owner_id', $owner->id)
            ->orderBy('id')
            ->get();

        return view('owner.restoran.edit', [
            'user' => $user,
            'owner' => $owner,
            'fotoMenus' => $fotoMenus,
            'reviews' => $reviews,
            'menuUnggulan' => $menuUnggulan,
            'menus' => $menus,
            'operational' => $operationals
        ]);
    }

    public function storeFotoMenu(Request $request)
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

    public function destroyFotoMenu($id)
    {
        $foto = FotoMenu::findOrFail($id);

        if ($foto->url && Storage::disk('public')->exists($foto->url)) {
            Storage::disk('public')->delete($foto->url);
        }

        $foto->delete();

        return back()->with('success', 'Foto menu berhasil dihapus!');
    }

    public function storeRestoran(Request $request)
    {
        $user = auth()->user();
        $owner = $user->owner;

        $validated = $request->validate([
            'nama_restoran' => 'required|string|max:255',
            'alamat_restoran' => 'required|string',
            'summary' => 'nullable|string',
            'lokasi_restoran' => 'nullable|string',
            'nib' => 'nullable|string|max:255',
        ]);

        $owner->update($validated);

        return back()->with('success', 'Data restoran berhasil diperbarui!');
    }

    public function storeOperational(Request $request)
    {
        $user = auth()->user();
        $owner = $user->owner;

        $validated = $request->validate([
            'jam_buka' => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i|after:jam_buka',
            'area' => 'nullable|array',
            'area.*' => 'in:Indoor,Outdoor,Semi Outdoor',
            'kategori_layanan' => 'required|array',
            'kategori_layanan.*' => 'string|max:255',
        ]);

        $validated['area'] = $validated['area'] ?? [];
        $validated['kategori_layanan'] = $validated['kategori_layanan'] ?? [];

        Operational::updateOrCreate(
            ['owner_id' => $owner->id],
            [
                'jam_buka' => $validated['jam_buka'],
                'jam_tutup' => $validated['jam_tutup'],
                'area' => $validated['area'],
                'kategori_layanan' => $validated['kategori_layanan'],
            ]
        );

        return back()->with('success', 'Data operasional berhasil diperbarui!');
    }

    public function storeFotoRestoran(Request $request)
    {
        $user = auth()->user();
        $owner = $user->owner;

        $request->validate([
            'foto_restoran' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        if ($owner->foto_restoran && Storage::disk('public')->exists($owner->foto_restoran)) {
            Storage::disk('public')->delete($owner->foto_restoran);
        }

        $path = $request->file('foto_restoran')->store('foto_restoran', 'public');
        $owner->update(['foto_restoran' => $path]);

        return back()->with('success', 'Foto restoran berhasil diperbarui!');
    }

    public function deleteFotoRestoran()
    {
        $user = auth()->user();
        $owner = $user->owner;

        if ($owner->foto_restoran && Storage::disk('public')->exists($owner->foto_restoran)) {
            Storage::disk('public')->delete($owner->foto_restoran);
            $owner->update(['foto_restoran' => null]);
            return back()->with('success', 'Foto restoran berhasil dihapus!');
        }

        return back()->with('error', 'Tidak ada foto restoran yang dapat dihapus.');
    }

    public function storeMenuUnggulan(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'owner_id' => 'required|exists:owners,id',
        ]);

        $exists = MenuUnggulan::where('menu_id', $validated['menu_id'])
            ->where('owner_id', $validated['owner_id'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Menu ini sudah ada di daftar unggulan.');
        }

        MenuUnggulan::create([
            'menu_id' => $validated['menu_id'],
            'owner_id' => $validated['owner_id'],
            'is_active' => true,
        ]);

        return back()->with('success', 'Menu unggulan berhasil ditambahkan.');
    }

    public function destroyMenuUnggulan(Request $request)
    {
        $id = $request->id;
        $unggulan = MenuUnggulan::findOrFail($id);
        $unggulan->delete();

        return back()->with('success', 'Menu unggulan berhasil dihapus.');
    }
}
