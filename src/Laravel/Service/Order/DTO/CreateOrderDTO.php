<?php

namespace ExampleApp\Laravel\Service\Order\DTO;

class CreateOrderDTO
{
    public function __construct(
        public string $referenceKey,
        public string $basketId,
        public int $productId,
        public int $supplierId,
        public int $warehouseId,
        public ?int $customerId,
        public int $quantity,
    ) {}

    public static function fromArray(array $data): CreateOrderDTO
    {
        return new self(
            referenceKey: $data['reference_key'],
            basketId: $data['basket_id'],
            productId: $data['product_id'],
            supplierId: $data['supplier_id'],
            warehouseId: $data['warehouse_id'],
            customerId: data_get($data, 'customer_id'),
            quantity: $data['quantity'],
        );
    }

    public function toArray(): array
    {
        return [
            'reference_key' => $this->referenceKey,
            'basket_id' => $this->basketId,
            'product_id' => $this->productId,
            'supplier_id' => $this->supplierId,
            'warehouse_id' => $this->warehouseId,
            'customer_id' => $this->customerId,
            'quantity' => $this->quantity,
        ];
    }
}
