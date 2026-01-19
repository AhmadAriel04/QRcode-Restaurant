<?php

namespace App\Services\Interfaces;


interface CartServiceInterface
{
    public function getCart(int $tableNumber);

    public function addItem(int $tableNumber, int $menuId, int $quantity);

    public function updateItem(int $cartId, int $quantity);

    public function removeItem(int $cartId);

    public function clearCart(int $tableNumber);
}
