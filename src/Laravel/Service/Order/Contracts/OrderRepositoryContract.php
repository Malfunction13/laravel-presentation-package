<?php

namespace ExampleApp\OrderPackage\Laravel\Service\Order\Contracts;

use ExampleApp\OrderPackage\Laravel\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryContract
{
    public function create(array $data): Order;
    public function getById(string $id): Order;
    public function getAllByUserId(int $userId): Collection;
    public function update(array $data): void;
    public function insert(array $data): void;
}
