<?php

namespace ExampleApp\OrderPackage\Laravel\Service\Order\Events;


use ExampleApp\OrderPackage\Laravel\Service\Order\Enums\OrderState;
use ExampleApp\OrderPackage\Laravel\Service\Order\Enums\OrderType;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStateChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public string $referenceKey,
        public OrderType $orderType,
        public ?OrderState $oldState,
        public ?OrderState $newState,
    ) {
    }
}
