<?php

namespace Rawahamid\FibIntegration;

use Illuminate\Http\JsonResponse;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class Fib
{
    protected static function baseUrl(): string
    {
        return match (config('fib.environment')) {
            'production' => 'https://fib.prod.fib.iq',
            default => 'https://fib.stage.fib.iq'
        };
    }

    protected static function checkResponse($response, $message = 'Internal Server Error')
    {
        if ($response->failed()) {
            throw new InternalErrorException($message, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
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
