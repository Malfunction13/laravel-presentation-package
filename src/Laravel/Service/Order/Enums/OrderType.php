<?php

namespace ExampleApp\Laravel\Service\Order\Enums;
enum OrderType: string
{
    case MAIN = 'MAIN';
    case SUB = 'SUB';
}
