<?php

namespace Rawahamid\FibIntegration;

use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Response;

class Fib
{
    protected static function baseUrl(): string
    {
        return match (config('fib.environment')) {
            'production' => 'https://fib.prod.fib.iq',
            'development' => 'https://fib.dev.fib.iq',
            default => 'https://fib.stage.fib.iq'
        };
    }

    /**
     * @throws InternalErrorException
     */
    protected static function checkResponse($response, $message = 'Internal Server Error')
    {
        if ($response->failed()) {
            throw new InternalErrorException($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response->json();
    }

    protected static function trimDescription($description)
    {
        if (strlen($description) > 50) {
            $description = substr($description, 0, 50 - 3);
            $description .= '...';
        }

        return $description;
    }
}
