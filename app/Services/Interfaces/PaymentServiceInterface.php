<?php

namespace App\Services\Interfaces;

use App\Models\Payment;

interface PaymentServiceInterface
{
    public function createForOrder(
        int $orderId,
        float $amount,
        string $method
    ): Payment;

    public function markAsPaid(
        int $paymentId,
        string $transactionId = null
    ): Payment;
}