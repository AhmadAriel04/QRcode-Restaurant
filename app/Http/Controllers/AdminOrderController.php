<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // List semua pesanan
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Detail pesanan
    public function show($id)
    {
        $order = Order::with('items.menu')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Update status pesanan
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
