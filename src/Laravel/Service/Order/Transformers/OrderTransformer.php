<?php

namespace ExampleApp\Laravel\Service\Order\Transformers;

use ExampleApp\Laravel\Models\Order;

class OrderTransformer
{
    public function __construct(
        private readonly OrderTransformerOverrideContract $orderTransformerOverride
    ) {}

    public function transform(Order $order): array
    {
        return $this->orderTransformerOverride->overrideMappings([
            'order' => [
                'reference_key' => $order->reference_key,
                'order_type' => $order->order_type->value,
                'basket_id' => $order->basket_id,
                'customer_reference_key' => $order->customer_reference_key,
                'order_payload' => $order->order_payload,
                'state' => $order->state->value,
            ],
        ]);
    }
}
