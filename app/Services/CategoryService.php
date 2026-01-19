<?php

namespace App\Services;

use App\Services\Interfaces\CategoryServiceInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryService implements CategoryServiceInterface
{
    protected CategoryRepositoryInterface $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAll()
    {
        return $this->categoryRepo->getAll();
    }

    public function find(int $id): Category
    {
        return $this->categoryRepo->findById($id);
    }
}
