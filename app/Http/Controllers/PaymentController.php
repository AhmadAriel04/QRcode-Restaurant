<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman pembayaran QRIS
     * Customer scan QRIS statis
     */
    public function showQris(Order $order)
    {
        // Jika belum ada payment, buat otomatis
        $payment = Payment::firstOrCreate(
            ['order_id' => $order->id],
            [
                'amount' => $order->total_price,
                'payment_method' => 'qris',
                'payment_status' => 'pending',
            ]
        );

        // QRIS statis (gambar yang kamu punya)
        $qrisImage = asset('images/qris.jpg');

        return view('payments.qris', compact('order', 'payment', 'qrisImage'));
    }

    public function cash(Order $order)
    {
    // Jika pembayaran CASH → tampilkan halaman info saja
    if ($order->payment_method === 'cash') {
        return view('payments.cash', compact('order'));
    }

    // QRIS FLOW
    $payment = Payment::firstOrCreate(
        ['order_id' => $order->id],
        [
            'amount' => $order->total_price,
            'payment_method' => 'cash',
            'payment_status' => 'pending',
        ]
    );


    return view('payments.cash', compact('order', 'payment'));
    }


    /**
     * Customer klik "Saya sudah bayar"
     * Status tetap pending (menunggu kasir)
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $order = Order::findOrFail($request->order_id);

        $path = $request->file('proof')->store('payments', 'public');

        // Tidak langsung paid → menunggu kasir
        $payment = Payment::where('order_id', $order->id)->first(); 
        $payment->update([
            'payment_status' => 'pending',
            'proof'  => $path,
        ]);

        return redirect()
            ->route('order.show', $order->id)
            ->with('success', 'Bukti Pembayaran berhasil dikirim, menunggu konfirmasi kasir.');
    }


    /**
     * KASIR / ADMIN: Konfirmasi pembayaran
     */
    public function approve(Payment $payment)
    {
        $payment->update([
            'payment_status' => 'pending',
            'paid_at' => now(),
        ]);

        // Update status order
        $payment->order->update([
            'qris' => 'paid',
            'cash' => 'paid'
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    /**
     * KASIR / ADMIN: Tolak pembayaran
     */
    public function reject(Payment $payment)
    {
        $payment->update([
            'payment_status' => 'failed',
        ]);

        return back()->with('error', 'Pembayaran ditolak.');
    }
}
