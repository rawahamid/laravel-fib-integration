<?php

namespace Rawahamid\FibIntegration;

use Illuminate\Support\ServiceProvider;

class FibIntegrationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/fib.php' => config_path('fib.php'),
        ],  ['fib']);
    }
}
