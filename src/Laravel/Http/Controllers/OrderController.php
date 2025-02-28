<?php

namespace ExampleApp\Laravel\Http\Controllers;

use ExampleApp\Laravel\Http\Requests\CreateOrderRequest;
use ExampleApp\Laravel\Service\Order\Services\OrderService;
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
