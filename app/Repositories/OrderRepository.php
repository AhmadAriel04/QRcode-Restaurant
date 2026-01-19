<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(
        int $tableNumber,
        ?string $customerName,
        string $paymentMethod,
        float $total,
        string $status
    ): Order {
        return Order::create([
            'table_number'   => $tableNumber, // FK ke tables.id
            'customer_name'  => $customerName,
            'payment_method' => $paymentMethod,
            'total_price'    => $total,
            'status'         => $status,
        ]);
    }

    public function addItem(
        int $orderId,
        int $menuId,
        int $qty,
        int $price
    ) {
        return OrderItem::create([
            'order_id' => $orderId,
            'menu_id'  => $menuId,
            'quantity' => $qty,
            'price'    => $price,
            'subtotal' => $qty * $price,
        ]);
    }

    public function updateStatus(int $orderId, string $status): Order
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $status]);

        return $order;
    }

    public function getByTableNumber(int $tableNumber)
    {
        return Order::where('table_number', $tableNumber)
            ->latest()
            ->get();
    }

    public function findById(int $id): Order
    {
        return Order::with('items.menu')->findOrFail($id);
    }
}
