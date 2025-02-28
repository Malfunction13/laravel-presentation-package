<?php

namespace ExampleApp\OrderPackage\Laravel\Repositories;


use ExampleApp\OrderPackage\Laravel\Models\Order;
use ExampleApp\OrderPackage\Laravel\Service\Order\Contracts\OrderRepositoryContract;
use ExampleApp\OrderPackage\Laravel\Service\Order\Events\OrderStateChanged;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderRepositoryContract
{

    public function __construct(
        protected readonly Order $model,
        protected readonly EventDispatcher $eventDispatcher,
    ) {}

    public function create(array $data): Order
    {
        $order = $this->model::query()->create($data);
        $this->eventDispatcher->dispatch(
            new OrderStateChanged($order->reference_key, $order->order_type, null, $order->state),
        );
        return $order;
    }

    public function getById(string $id): Order
    {
        return $this->model->query()->find($id);
        // TODO: Implement getById() method.
    }

    public function getAllByUserId(int $userId): Collection
    {
        return new Collection();
        // TODO: Implement getAllByUserId() method.
    }

    public function update(array $data): void
    {
        // TODO: Implement update() method.
    }

    public function insert(array $data): void
    {
        // TODO: Implement insert() method.
    }
}
