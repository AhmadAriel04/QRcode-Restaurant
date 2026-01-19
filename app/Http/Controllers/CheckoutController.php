<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\CheckoutServiceInterface;

class CheckoutController extends Controller
{
    public function __construct(
        protected CheckoutServiceInterface $checkoutService
    ) {}

    public function checkout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,qris',
            'customer_name'  => 'nullable|string|max:100',
        ]);

        if (!session()->has('table_number')) {
            return redirect('/')
                ->with('error', 'Meja belum dipilih');
        }

        try {
            $order = $this->checkoutService->checkout(
                session('table_number'),
                $request->customer_name,
                $request->payment_method
            );

            // Jika QRIS → ke halaman pembayaran
            if ($order->payment_method === 'qris') {
                return redirect()
                    ->route('payment.qris', $order->id);
            }

            // CASH → langsung selesai
            if ($order->payment_method === 'cash'){
            return redirect()->route('payment.cash', $order->id)
            ->with('success', 'Silakan Bayar ke Kasir');
            }

        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}
