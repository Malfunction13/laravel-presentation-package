<?php

namespace ExampleApp\OrderPackage\Laravel\Service\Order\Services;

use ExampleApp\OrderPackage\Laravel\Service\Order\Contracts\OrderRepositoryContract;
use ExampleApp\OrderPackage\Laravel\Service\Order\DTO\CreateOrderDTO;
use ExampleApp\OrderPackage\Laravel\Service\Order\Enums\OrderState;
use ExampleApp\OrderPackage\Laravel\Service\Order\Enums\OrderType;
use ExampleApp\OrderPackage\Laravel\Service\Order\Transformers\OrderTransformer;
use ExampleApp\OrderPackage\Laravel\Service\Order\Transformers\OrderTransformerOverrideContract;

class OrderService
{
    public function __construct(
        private readonly OrderRepositoryContract $orderRepository,
        private readonly OrderTransformer $orderTransformer,
        private readonly OrderTransformerOverrideContract $orderTransformerOverride,
        private readonly array $warehouseIdsMapping,
    ) {}

    public function create(CreateOrderDTO $createOrderDTO): array
    {
        if (!array_key_exists($createOrderDTO->warehouseId ,$this->warehouseIdsMapping)) {
            // Oops condition - early exit scenario - throw something
            return [];
        }

        $order = $this->orderRepository->create($this->mapOrderData($createOrderDTO));

        return $this->orderTransformerOverride->overrideMappings($this->orderTransformer->transform($order));
    }

    private function mapOrderData(CreateOrderDTO $createOrderDTO): array
    {
        return [
            'reference_key' => $createOrderDTO->referenceKey,
            'basket_id' => $createOrderDTO->basketId,
            'customer_reference_key' => (string)$createOrderDTO->customerId,
            'order_payload' => $createOrderDTO,
            'state' => OrderState::FRAUD_CHECK_PENDING,
            'order_type' => OrderType::MAIN,
        ];
    }

}
