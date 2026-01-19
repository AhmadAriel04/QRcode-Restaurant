<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\MenuServiceInterface;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected MenuServiceInterface $menuService;

    public function __construct(MenuServiceInterface $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * Tampilkan semua menu
     */
    public function index()
    {
        $menus = $this->menuService->getAll();

        return view('menus.index', compact('menus'));
    }

    /**
     * Tampilkan menu berdasarkan kategori
     */
    public function byCategory(int $categoryId)
    {
        $menus = $this->menuService->getByCategory($categoryId);

        return view('menu.category', compact('menus'));
    }

    /**
     * Detail menu
     */
    public function show(int $id)
    {
        $menu = $this->menuService->find($id);

        return view('menus.show', compact('menus'));
    }
}
