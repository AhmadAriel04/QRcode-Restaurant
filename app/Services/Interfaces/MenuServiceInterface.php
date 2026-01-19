<?php

namespace App\Services\Interfaces;

use App\Models\Menu;

interface MenuServiceInterface
{
    public function getAll();
    public function getByCategory(int $categoryId);
    public function find(int $id): Menu;
}
