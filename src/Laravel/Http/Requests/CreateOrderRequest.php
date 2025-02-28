<?php

namespace ExampleApp\OrderPackage\Laravel\Http\Requests;

use ExampleApp\OrderPackage\Laravel\Service\Order\DTO\CreateOrderDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'reference_key' => 'required|string',
            'basket_id' => 'required|string',
            'product_id' => 'required|numeric',
            'supplier_id' => 'required|numeric',
            'warehouse_id' => 'required|numeric',
            'user_id' => 'nullable|numeric',
            'quantity' => 'required|numeric|min:1',
        ];
    }

    public function dto(): CreateOrderDTO
    {
        return CreateOrderDTO::fromArray($this->validated());
    }
}
