<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\OrderServiceInterface;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct(
        protected OrderServiceInterface $orderService
    ) {}

    public function checkout(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:100',
            'payment_method' => 'required|in:cash,qris',
        ]);

        $tableNumber = session('table_number');

        try {
            $order = $this->orderService->checkoutFromCart(
                $tableNumber,
                $request->customer_name,
                $request->payment_method
            );

            return view('order_success', compact('order'));

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function history()
    {
        $tableNumber = session('table_number');

        $orders = $this->orderService->getHistory($tableNumber);

        return view('order_history', compact('orders'));
    }

    public function detail(int $id)
    {
        $order = $this->orderService->getDetail($id);

        return view('order_detail', compact('order'));
    }

    public function show(Order $order) {
        return view('order.show', compact('order'));
    }
}
