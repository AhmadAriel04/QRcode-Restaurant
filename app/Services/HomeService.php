<?php

namespace App\Services;

use App\Models\Category;

class HomeService implements HomeServiceInterface
{
    public function setTable(int $tableNumber): void
    {
        session(['table_number' => $tableNumber]);
    }

    public function getHomeData(): array
    {
        if (!session()->has('table_number')) {
            abort(403, 'Meja belum dipilih');
        }

        return [
            'tableNumber' => session('table_number'),
            'categories'  => Category::with('menus')->get()
        ];
    }
}
