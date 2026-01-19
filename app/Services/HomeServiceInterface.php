<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface HomeServiceInterface
{
    public function getHomeData(): array;
    public function setTable(int $tableNumber): void;
}
