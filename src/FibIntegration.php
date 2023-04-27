<?php

namespace Rawahamid\FibIntegration;

use Illuminate\Support\Facades\Facade;

class FibIntegration extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'laravel-fib-integration';
    }
}
