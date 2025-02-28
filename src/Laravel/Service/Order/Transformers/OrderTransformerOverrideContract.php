<?php

namespace ExampleApp\OrderPackage\Laravel\Service\Order\Transformers;

interface OrderTransformerOverrideContract
{
    public function overrideMappings(array $default): array;

}
