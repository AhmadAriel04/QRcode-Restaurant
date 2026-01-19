<?php

namespace App\Services;

use App\Repositories\PaymentRepositoryInterface;
use App\Services\Interfaces\PaymentServiceInterface;
use App\Models\Payment;

class PaymentService implements PaymentServiceInterface
{
    public function __construct(
        protected PaymentRepositoryInterface $paymentRepo
    ) {}

    public function createForOrder(
        int $orderId,
        float $amount,
        string $method
    ): Payment {
        return $this->paymentRepo->create([
            'order_id'       => $orderId,
            'amount'         => $amount,
            'payment_method' => $method,
            'payment_status' => 'pending',
        ]);
    }

    public function markAsPaid(
        int $paymentId,
        ?string $transactionId = null
    ): Payment {
        return $this->paymentRepo->updateStatus(
            $paymentId,
            'paid',
            $transactionId
        );
    }
}

