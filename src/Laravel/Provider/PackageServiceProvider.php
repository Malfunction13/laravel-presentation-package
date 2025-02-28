<?php

namespace ExampleApp\Laravel\Provider;

use ExampleApp\Laravel\Service\Order\Contracts\OrderRepositoryContract;
use ExampleApp\Laravel\Service\Order\Services\OrderService;
use ExampleApp\Laravel\Service\Order\Transformers\OrderTransformerOverrideContract;
use ExampleApp\Laravel\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;



// All providers from our package can be automatically picked up by the laravel app that requires them as long as
// we register in our composer.json (package) in the "extra" property.
// The application does not need to manually register these providers in config/app.php.
class PackageServiceProvider  extends ServiceProvider
{
    // we use the boot() method to bind data and functionality to our application container when that data and
    // functionality when the binding depends on other services being fully resolved
    // This method is called after all other service providers have been registered, meaning you have access to all
    // other services that have been registered by the framework
    // E.g. interactions that depend on routes, middleware, event listeners, or other services being fully initialized
    public function boot(): void
    {
        // this allows us to publish our configuration and exposes it to our app by copying the package config
        // to our application's config folder
        $this->publishes([
            __DIR__ . '/../config/order-config.php' => $this->app->configPath('order-package/order-config.php'),
            __DIR__ . '/../config/etc-config.php' => $this->app->configPath('order-package/etc-config.php'),
        ]);

        // we can also set up auto publishing through composer.json "scripts" in the post-install-cmd and post-update-cmd
        // inject routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        // inject migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        // register bindings
        $this->registerBindings();
        // cli commands
//        $this->commands([
//            SomeCommand::class,
//        ]);
    }

    // we use the register() method for similar activities to boot() with the important difference that here we will
    // register bindings that are INDEPENDENT of other services - this is our primary way of injecting into our IOC
    public function register(): void
    {

        // set automatic publishing of configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/order-config.php', 'order-package.order-config');
        $this->mergeConfigFrom(__DIR__ . '/../config/etc-config.php', 'order-package.etc-config');

        // here we can register each of our services or so-called modules (large logical chunks responsible for specific
        // tasks dictated by the business requirement
    }

    // here we determine the bindings we provide to our Laravel app's dependency container
    // usually we encapsulate bindings in such register functions in order to make it clear and nice
    public function registerBindings(): void
    {
        $this->registerOrderBindings();
    }

    private function registerOrderBindings(): void
    {
        // we can bind interfaces to concrete implementations
        // via binding directive
        $this->app->bind(OrderTransformerOverrideContract::class, config('order-package.order-config.order.transformer'));
        // via singleton
        $this->app->singleton(OrderRepositoryContract::class, OrderRepository::class);


        // contextual binding
        // we can provide values to be injected into our classes instantiated by Laravel container from configs
        $this->app->when(OrderService::class)
            ->needs('$warehouseIdsMapping')
            ->giveConfig('order-package.order-config.warehouse_ids_mapping');
    }
}
