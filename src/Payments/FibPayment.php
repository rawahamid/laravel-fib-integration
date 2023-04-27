<?php

namespace Rawahamid\FibIntegration\Payments;

use Illuminate\Support\Facades\Http;
use Rawahamid\FibIntegration\Fib;
use Rawahamid\FibIntegration\Interfaces\PaymentInterface;

class FibPayment extends Fib implements PaymentInterface
{
    public static function authenticate()
    {
        $response = Http::asForm()->post(self::baseUrl() . '/auth/realms/fib-online-shop/protocol/openid-connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => config('fib.client_id'),
            'client_secret' => config('fib.client_secret'),
        ]);

        return self::checkResponse($response, 'Payment Creation Failed');
    }

    public static function create($amount, $description = '')
    {
        $description = self::trimDescription($description);

        $response = Http::withToken(self::authenticate()['access_token'])
            ->post(self::baseUrl() . '/protected/v1/payments', [
                'monetaryValue' => [
                    'amount' => $amount,
                    'currency' => 'IQD',
                ],
                'statusCallbackUrl' => config('fib.callback_url'),
                'description' => $description,
            ]);

        return self::checkResponse($response, 'Payment Creation Failed');
    }

    public static function cancel($paymentId)
    {
        $response = Http::withToken(self::authenticate()['access_token'])
            ->post(self::baseUrl() . '/protected/v1/payments/'.$paymentId.'/cancel');

        return self::checkResponse($response, 'Cancel Payment Failed');
    }

    public static function status($paymentId)
    {
        $response = Http::withToken(self::authenticate()['access_token'])
            ->get(self::baseUrl() . '/protected/v1/payments/'.$paymentId.'/status');

        return self::checkResponse($response, 'Check Payment Status Failed');
    }
}
