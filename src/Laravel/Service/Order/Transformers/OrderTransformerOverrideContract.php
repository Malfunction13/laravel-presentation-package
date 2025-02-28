<?php

namespace ExampleApp\Laravel\Service\Order\Transformers;

interface OrderTransformerOverrideContract
{
    public function overrideMappings(array $default): array;

}
