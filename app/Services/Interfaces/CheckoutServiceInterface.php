<?php

namespace App\Services\Interfaces;

use App\Models\Order;

interface CheckoutServiceInterface
{
    public function checkout(
        int $tableNumber,
        ?string $customerName,
        string $paymentMethod
    ): Order;
}
