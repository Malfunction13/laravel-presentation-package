<?php

namespace ExampleApp\OrderPackage\Laravel\Service\Order\Listeners;

use ExampleApp\OrderPackage\Laravel\Service\Order\Events\OrderStateChanged;
use Psr\Log\LoggerInterface;

class LogOrderStateChange
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    public function handle(OrderStateChanged $event): void
    {
        $this->logger->info(
            "Order state changed",
            [
                'reference_key' => $event->referenceKey,
                'oldState' => $event->oldState,
                'newState' => $event->newState,
            ]
        );
    }

}
