<?php

namespace App\Repositories;

use App\Models\Menu;

class MenuRepository implements MenuRepositoryInterface
{
    public function getAll()
    {
        return Menu::with('category')->get();
    }

    public function getByCategory(int $categoryId)
    {
        return Menu::where('category_id', $categoryId)
            ->with('category')
            ->get();
    }

    public function findById(int $id): Menu
    {
        return Menu::with('category')->findOrFail($id);
    }
}
