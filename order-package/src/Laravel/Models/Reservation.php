<?php

namespace ExampleApp\OrderPackage\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation  extends Model
{

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
