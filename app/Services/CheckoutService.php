<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\CheckoutServiceInterface;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Services\Interfaces\PaymentServiceInterface;

class CheckoutService implements CheckoutServiceInterface
{
    public function __construct(
        protected CartRepositoryInterface $cartRepo,
        protected OrderRepositoryInterface $orderRepo,
        protected PaymentServiceInterface $paymentService
    ) {}

    public function checkout(
        int $tableNumber,
        ?string $customerName,
        string $paymentMethod
    ): Order {
        return DB::transaction(function () use (
            $tableNumber,
            $customerName,
            $paymentMethod,
        ) {

            // 1. Ambil cart
            $cartItems = $this->cartRepo->getByTableNumber($tableNumber);

            if ($cartItems->isEmpty()) {
                throw new \Exception('Keranjang masih kosong');
            }

            $total = $cartItems->sum('total_price');

            $status = $paymentMethod === 'cash'
            ? 'paid'
            : 'pending';

            // 2. Buat order + order items
            $order = $this->orderRepo->create(
                $tableNumber,
                $customerName,
                $paymentMethod,
                $total,
                $status
            );

            // 3. Buat payment
            $this->paymentService->createForOrder(
                orderId: $order->id,
                amount: $order->total_price,
                method: $paymentMethod
            );

            foreach ($cartItems as $item) {
                $this->orderRepo->addItem(
                    $order->id,
                    $item->menu_id,
                    $item->quantity,
                    $item->total_price
                );
            }

            // 4. Kosongkan cart
            $this->cartRepo->clearByTableNumber($tableNumber);

            return $order;
        });
    }
}
