<?php

use ExampleApp\OrderPackage\Laravel\Service\Order\Transformers\OrderTransformerOverrideDefault;

return [
    'routes' => [
        'prefix' => '/api/order',
    ],
    'order' => [
        'transformer' => OrderTransformerOverrideDefault::class
    ],
    'warehouse_ids_mapping' => [
        1 => 'Hamburg',
        2 => 'Berlin',
        3 => 'Jena',
    ]
];

