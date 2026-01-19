<?php

namespace App\Services;

use App\Services\Interfaces\CartServiceInterface;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\MenuRepositoryInterface;
use App\Models\Menu;

class CartService implements CartServiceInterface
{
    public function __construct(
        protected CartRepositoryInterface $cartRepo,
        protected MenuRepositoryInterface $menuRepo
    ) {}

    public function getCart(int $tableNumber)
    {
        return $this->cartRepo->getByTableNumber($tableNumber);
    } 

    public function addItem(int $tableNumber, int $menuId, int $quantity)
    {
        $menu = Menu::findOrFail($menuId);

        $this->cartRepo->create([
            'table_number' => $tableNumber,
            'menu_id'      => $menuId,
            'quantity'     => $quantity,
            'total_price'  => $menu->price * $quantity,
        ]);
    }

    public function updateItem(int $cartId, int $quantity)
    {
        $cart = $this->cartRepo->find($cartId);
        $cart->update([
            'quantity'      => $quantity,
            'total_price'   => $cart->menu->price * $quantity,
        ]);
    }

    public function removeItem(int $cartId)
    {
        return $this->cartRepo->delete($cartId);
    }

    public function clearCart(int $tableNumber)
    {
        return $this->cartRepo->clearByTableNumber($tableNumber);
    }
}