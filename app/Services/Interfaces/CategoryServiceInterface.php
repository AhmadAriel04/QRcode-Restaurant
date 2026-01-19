<?php

namespace App\Services\Interfaces;

use App\Models\Category;

interface CategoryServiceInterface
{
    public function getAll();
    public function find(int $id): Category;
}
