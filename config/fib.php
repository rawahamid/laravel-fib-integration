<?php

return [
   /*
   |--------------------------------------------------------------------------
   | Integration Environment
   |--------------------------------------------------------------------------
   |
   | This value is the environment that you want to choose for FIB integration to your application.
   | values are (dev, stage, prod)
   |
   */
    'environment' => env('FIB_ENVIRONMENT', 'stage'),

   /*
   |--------------------------------------------------------------------------
   | Callback URL
   |--------------------------------------------------------------------------
   |
   | The callback url that FIB will send a POST request to when status of the created payment changes.
   | Callback URL should be able to handle POST requests with request body that contains two properties: id and status
   */
    'callback_url' => env('FIB_CALLBACK_URL', 'http://127.0.0.1:8000'),

   /*
   |--------------------------------------------------------------------------
   | Client ID
   |--------------------------------------------------------------------------
   |
   | The account credentials you use to authenticate the request determines whether the request is live mode or test mode
   | FIB will provide it for you
   */
    'client_id' => env('FIB_CLIENT_ID'),

    'client_secret' => env('FIB_CLIENT_SECRET'),
];
