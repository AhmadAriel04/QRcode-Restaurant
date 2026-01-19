<?php

namespace App\Repositories;

use App\Models\Payment;

interface PaymentRepositoryInterface
{
    public function create(array $data): Payment;

    public function updateStatus(
        int $paymentId,
        string $status,
        ?string $transactionId = null
    ): Payment;

    public function findByOrder(int $orderId): ?Payment;
}

