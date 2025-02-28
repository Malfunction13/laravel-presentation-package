<?php

namespace ExampleApp\OrderPackage\Laravel\Service\Order\Transformers;


class OrderTransformerOverrideDefault implements OrderTransformerOverrideContract
{
    public function overrideMappings(array $default): array
    {
        return array_merge($default, []);
    }
}
