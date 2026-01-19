<?php

namespace App\Repositories;

interface CartRepositoryInterface
{
    public function getByTableNumber(int $tableNumber);
    public function create(array $data);
    public function find(int $id);
    public function delete(int $id);
    public function clearByTableNumber(int $tableNumber);
}
