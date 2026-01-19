<?php

namespace App\Services\Interfaces;

use App\Models\Order;

interface OrderServiceInterface
{
    public function checkoutFromCart(
        int $tableNumber,
        string $customerName,
        string $paymentMethod
    ): Order;

    public function getHistory(int $tableNumber);

    public function getDetail(int $id): Order;
}
