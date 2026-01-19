<?php

namespace App\Repositories;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function findById(int $id): Category;
}
