<?php

namespace App\Repositories;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function create(
        int $tableNumber,
        ?string $customerName,
        string $paymentMethod,
        float $total,
        string $status
    ): Order;

    public function addItem(
        int $orderId,
        int $menuId,
        int $qty,
        int $price
    );

    public function updateStatus(int $orderId, string $status): Order;

    public function getByTableNumber(int $tableNumber);

    public function findById(int $id): Order;
}
