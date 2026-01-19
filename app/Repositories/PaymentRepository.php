<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function create(array $data): Payment
    {
        return Payment::create($data);
    }

    public function updateStatus(
        int $paymentId,
        string $status,
        ?string $transactionId = null
    ): Payment {
        $payment = Payment::findOrFail($paymentId);
        $payment->update([
            'payment_status' => $status,
            'transaction_id' => $transactionId,
        ]);

        return $payment;
    }

    public function findByOrder(int $orderId): ?Payment
    {
        return Payment::where('order_id', $orderId)->first();
    }
}