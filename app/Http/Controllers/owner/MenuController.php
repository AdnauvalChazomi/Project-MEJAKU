<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\FotoMenu;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $owner = $user->owner;

        $menus = Menu::where('owner_id', $owner->id)->get();
        $fotoMenus = FotoMenu::where('owner_id', $owner->id)->get();

        return view('owner.menu.index', compact('user', 'menus', 'fotoMenus'));
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

    public function create()
    {
        $user = auth()->user();

        $kategoriOptions = ['makanan', 'minuman', 'dessert', 'lainnya'];

        return view('owner.menu.create', compact('user', 'kategoriOptions'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $owner = $user->owner;

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:makanan,minuman,dessert,lainnya',
            'harga' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('menus', 'public');
            $validated['foto'] = $path;
        }

        $validated['owner_id'] = $owner->id;

        Menu::create($validated);

        return redirect()
            ->route('menu.index', ['id' => $owner->id])
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = auth()->user();
        $menu = Menu::findOrFail($id);
        $kategoriOptions = ['makanan', 'minuman', 'dessert', 'lainnya'];

        return view('owner.menu.edit', compact('user', 'menu', 'kategoriOptions'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:makanan,minuman,dessert,lainnya',
            'harga' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($menu->foto && Storage::disk('public')->exists($menu->foto)) {
                Storage::disk('public')->delete($menu->foto);
            }

            $path = $request->file('foto')->store('menus', 'public');
            $validated['foto'] = $path;
        }

        $menu->update($validated);

        return redirect()
            ->route('menu.index', ['id' => $menu->owner_id])
            ->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->foto && Storage::disk('public')->exists($menu->foto)) {
            Storage::disk('public')->delete($menu->foto);
        }

        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus!');
    }
}
