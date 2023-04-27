<?php

namespace Rawahamid\FibIntegration\Interfaces;

interface PaymentInterface
{
    public static function authenticate();

    public static function create($amount, $description);

    public static function status($paymentId);

    public static function cancel($paymentId);
}
