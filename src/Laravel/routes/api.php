<?php

use ExampleApp\Laravel\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// we can also call config() helper whenever we do not deal with instantiable classes like in this case below
Route::prefix(config('order-package.routes.prefix'))
    ->group(function (): void {
        Route::post('/create', [OrderController::class, 'create'])
            ->name('order.create');
});

