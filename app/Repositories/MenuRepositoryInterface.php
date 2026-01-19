<?php

namespace App\Repositories;

use App\Models\Menu;

interface MenuRepositoryInterface
{
    public function getAll();
    public function getByCategory(int $categoryId);
    public function findById(int $id): Menu;
}
