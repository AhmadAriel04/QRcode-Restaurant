<?php

namespace App\Services;

use App\Repositories\CartRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Services\Interfaces\OrderServiceInterface;
use App\Models\Order;

class OrderService implements OrderServiceInterface
{
    protected CartRepositoryInterface $cartRepo;
    protected OrderRepositoryInterface $orderRepo;

    public function __construct(
        CartRepositoryInterface $cartRepo,
        OrderRepositoryInterface $orderRepo
    ) {
        $this->cartRepo  = $cartRepo;
        $this->orderRepo = $orderRepo;
    }

    public function checkoutFromCart(
        int $tableNumber,
        ?string $customerName,
        string $paymentMethod
    ): Order {
        // 1️⃣ Ambil cart (SESUIAI DATABASE)
        $cartItems = $this->cartRepo->getByTableNumber($tableNumber);

        if ($cartItems->isEmpty()) {
            throw new \Exception('Keranjang kosong');
        }

        // 3️⃣ Hitung total
        $total = $cartItems->sum('total_price');

        // 4️⃣ Tentukan status (INI YANG HILANG)
        $status = $paymentMethod === 'cash' ? 'paid' : 'pending';

        // 5️⃣ Buat order
        $order = $this->orderRepo->create(
            $tableNumber,
            $customerName,
            $paymentMethod,
            $total,
            $status
        );

        // 6️⃣ Order items
        foreach ($cartItems as $item) {
            $this->orderRepo->addItem(
                $order->id,
                $item->menu_id,
                $item->quantity,
                $item->menu->price
            );
        }

        // 7️⃣ Clear cart (PAKAI table_number)
        $this->cartRepo->clearByTableNumber($tableNumber);

        return $order;
    }

    public function getHistory(int $tableNumber)
    {
        return $this->orderRepo->getByTableNumber($tableNumber);
    }

    public function getDetail(int $id): Order
    {
        return $this->orderRepo->findById($id);
    }
}
