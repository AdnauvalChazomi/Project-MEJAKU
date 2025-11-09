<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Reservation;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreorderController extends Controller
{
    public function index($reservationId)
    {
        $reservation = Reservation::with('owner')->findOrFail($reservationId);

        $user = auth()->user();
        $customer = $user->customer;

        if ($reservation->customer_id !== $customer->id) {
            abort(403, 'Anda tidak berhak mengakses reservasi ini.');
        }

        if ($reservation->order) {
            return redirect()
                ->route('payment.show', $reservation->id)
                ->with('error', 'Anda tidak dapat memesan lagi, reservasi sudah memiliki order.');
        }

        $restoran = $reservation->owner;
        $menus = $restoran->menus()->orderBy('nama')->get();

        return view('user.reservations.preorder', compact('reservation', 'restoran', 'menus'));
    }

    public function store(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        $user = auth()->user();
        $customer = $user->customer;

        if ($reservation->customer_id !== $customer->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak berhak mengakses reservasi ini.'
            ], 403);
        }

        $items = $request->input('items', []);

        if (empty($items)) {
            return response()->json([
                'success' => true,
                'message' => 'Tidak ada menu yang dipilih.',
                'total' => 0,
                'redirect' => route('payment', $reservation->id)
            ]);
        }

        $validated = $request->validate([
            'items' => 'array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($validated, $reservation, $customer) {
            $order = Order::where('reservation_id', $reservation->id)
                ->where('customer_id', $customer->id)
                ->first();

            if (!$order) {
                $order = Order::create([
                    'customer_id' => $customer->id,
                    'reservation_id' => $reservation->id,
                    'total_harga' => 0,
                ]);
            } else {
                $order->items()->delete();
            }

            $totalHarga = 0;

            foreach ($validated['items'] as $item) {
                $menu = Menu::findOrFail($item['menu_id']);
                $quantity = $item['quantity'];
                $subtotal = $menu->harga * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'jumlah' => $quantity,
                    'harga_satuan' => $menu->harga,
                    'subtotal' => $subtotal,
                ]);

                $totalHarga += $subtotal;
            }

            $order->update(['total_harga' => $totalHarga]);

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil disimpan dan item diperbarui!',
                'total' => $totalHarga,
                'redirect' => route('payment', $reservation->id)
            ]);
        });
    }

    public function show($id)
    {
        $reservation = Reservation::with([
            'owner',
            'customer',
            'order.items.menu'
        ])->findOrFail($id);

        if ($reservation->customer_id !== auth()->user()->customer->id) {
            abort(403, 'Anda tidak berhak mengakses reservasi ini.');
        }

        return view('user.reservations.show', [
            'reservation' => $reservation,
        ]);
    }

    public function confirm(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->customer_id !== auth()->user()->customer->id) {
            abort(403, 'Anda tidak berhak mengubah catatan reservasi ini.');
        }

        $validated = $request->validate([
            'catatan' => 'nullable|string|max:255',
        ]);

        $reservation->update([
            'catatan' => $validated['catatan']
        ]);

        return redirect()
            ->route('history')
            ->with('success', 'Catatan berhasil disimpan.');
    }

    public function destroy($id)
    {
        $order = Order::where('reservation_id', $id)->first();

        if (!$order) {
            return back()->with('error', 'Order tidak ditemukan.');
        }

        $order->delete();

        return redirect()->route('preorder', $id)->with('success', 'Order beserta semua menu berhasil dihapus.');
    }
}
