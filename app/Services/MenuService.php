<?php

namespace App\Services;

use App\Services\Interfaces\MenuServiceInterface;
use App\Repositories\MenuRepositoryInterface;
use App\Models\Menu;

class MenuService implements MenuServiceInterface
{
    protected MenuRepositoryInterface $menuRepo;

    public function __construct(MenuRepositoryInterface $menuRepo)
    {
        $this->menuRepo = $menuRepo;
    }

    public function getAll()
    {
        return $this->menuRepo->getAll();
    }

    public function getByCategory(int $categoryId)
    {
        return $this->menuRepo->getByCategory($categoryId);
    }

    public function find(int $id): Menu
    {
        return $this->menuRepo->findById($id);
    }
}
