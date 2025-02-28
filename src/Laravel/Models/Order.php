<?php

namespace ExampleApp\Laravel\Models;


use ExampleApp\Laravel\Service\Order\Enums\OrderState;
use ExampleApp\Laravel\Service\Order\Enums\OrderType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

// To get type hinting for our Eloquent Model we need to add
/**
 * @property-read int $id
 * @property string $reference_key
 * @property string $basket_id
 * @property string $customer_reference_key
 * @property array $order_payload
 * @property OrderState $state
 * @property OrderType $order_type
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
class Order extends Model
{

    protected $fillable = [
        'reference_key',
        'order_type',
        'basket_id',
        'customer_reference_key',
        'order_payload',
        'state',
    ];

    // casts will allow us to cast our values into enum types and interact with them as below:
    // $order->state !== OrderState::FRAUD_CHECK_PENDING
    protected $casts = [
        'order_payload' => 'array',
        'state' => OrderState::class,
        'order_type' => OrderType::class,
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'order_id', 'id');
    }
}
