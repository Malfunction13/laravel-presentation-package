<?php

namespace ExampleApp\OrderPackage\Laravel\Provider;

use ExampleApp\OrderPackage\Laravel\Service\Order\Events\OrderStateChanged;
use ExampleApp\OrderPackage\Laravel\Service\Order\Listeners\LogOrderStateChange;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseServiceProvider;

// This Provider is responsible for registering events and mapping them to listeners (handlers)
class PackageEventServiceProvider extends BaseServiceProvider
{
    protected $listen = [
        OrderStateChanged::class => [ // we map the event to the corresponding listeners
            LogOrderStateChange::class,
            // here we can add additional listeners that would be triggered and handle separate tasks
        ],
    ];
}
