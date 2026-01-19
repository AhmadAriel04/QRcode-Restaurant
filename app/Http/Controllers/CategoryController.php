<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\CategoryServiceInterface;

class CategoryController extends Controller
{
    protected CategoryServiceInterface $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAll();

        return view('category.index', compact('categories'));
    }

    public function show(int $id)
    {
        $category = $this->categoryService->find($id);

        return view('category.show', compact('category'));
    }
}
