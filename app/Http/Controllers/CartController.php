<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\CartServiceInterface;

class CartController extends Controller
{
    public function __construct(
        protected CartServiceInterface $cartService
    ) {}

    public function index()
    {
        $tableNumber = session('table_number');

        $carts = $this->cartService->getCart($tableNumber);

        return view('cart.index', compact('carts'));
    }

    public function add(Request $request, int $id)
    {
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $tableNumber = session('table_number');

    $this->cartService->addItem(
        $tableNumber,
        $id, // ← menu_id dari URL
        $request->quantity
    );

    return redirect()->route('cart.index')
        ->with('success', 'Menu ditambahkan ke keranjang');
    }


    public function update(Request $request, int $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $this->cartService->updateItem($id, $request->quantity);

        return back()->with('success', 'Jumlah diperbarui');
    }

    public function remove(int $id)
    {
        $this->cartService->removeItem($id);

        return back()->with('success', 'Item dihapus');
    }

    public function clear()
    {
    $tableNumber = session('table_number');

    if (!$tableNumber) {
        return back()->with('error', 'Meja belum dipilih');
    }

    $this->cartService->clearCart($tableNumber);

    return back()->with('success', 'Keranjang berhasil dikosongkan');
    }

}
