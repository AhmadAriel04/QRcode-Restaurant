<?php

namespace App\Repositories;

use App\Repositories\CartRepositoryInterface;
use App\Models\Cart;

class CartRepository implements CartRepositoryInterface
{
    public function getByTableNumber(int $tableNumber)
    {
        return Cart::with('menu')
            ->where('table_number', $tableNumber)
            ->get();
    }

    public function create(array $data)
    {
        return Cart::create($data);
    }


    public function find(int $id)
    {
        return Cart::findOrFail($id);
    }

    public function delete(int $id)
    {
        Cart::destroy($id);
    }

    public function clearByTableNumber(int $tableNumber)
    {
        return Cart::where('table_number', $tableNumber)->delete();
    }
}
