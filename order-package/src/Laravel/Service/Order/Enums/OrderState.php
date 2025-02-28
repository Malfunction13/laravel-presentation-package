<?php

namespace ExampleApp\OrderPackage\Laravel\Service\Order\Enums;

enum OrderState: string
{
    case FRAUD_CHECK_PENDING = 'FRAUD_CHECK_PENDING';
    case FRAUD_CHECK_SUCCESSFUL = 'FRAUD_CHECK_SUCCESSFUL';
    case DELEGATED = 'DELEGATED';
    case FRAUD_CHECK_FAILED = 'FRAUD_CHECK_FAILED';
    case CANCELLED = 'CANCELLED';
}
