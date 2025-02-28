<?php

namespace ExampleApp\OrderPackage\Laravel\Http\Controllers;

use ExampleApp\OrderPackage\Laravel\Http\Requests\CreateOrderRequest;
use ExampleApp\OrderPackage\Laravel\Service\Order\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{
    public function __construct(
       private readonly OrderService $orderService
    ) {}

    public function create(CreateOrderRequest $request): JsonResponse
    {
        return response()->json($this->orderService->create($request->dto()));
    }
}
