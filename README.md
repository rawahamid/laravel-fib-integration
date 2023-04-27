# Laravel FIB Integration

Laravel integration for first iraqi bank payment

## Features
- Authentication
- Payment Creation
- Checking payment status
- Payment Cancellation

## Installation

You can install the package through Composer
```bash
composer require rawahamid/laravel-fib-integration
```

Then publish the config file of the package using the vendor publish command
```bash
php artisan vendor:publish --tag="fib"
```

## Configuration variables
All that is left to do is to define four env configuration variables inside `.env` file
```dotenv
FIB_ENVIRONMENT="staging"
FIB_CALLBACK_URL="https://localhost:8000/fib-callback-url"
FIB_CLIENT_ID="client-id"
FIB_CLIENT_SECRET="client-secret"
```

- `FIB_ENVIRONMENT` This value is the environment that you want to choose for FIB integration to your application
- `FIB_CALLBACK_URL` The callback url that FIB will send a POST request to when status of the created payment changes 
- `FIB_CLIENT_ID` The account client id you use to authenticate the request determines whether the request is live mode or test mode
- `FIB_CLIENT_SECRET` The account client secret you use to authenticate the request determines whether the request is live mode or test mode

## Usage

#### Payment Creation
```php
use Rawahamid\FibIntegration\Payments\FibPayment;

$response = FibPayment::create(100);
```

Response structure
```json
{
    "paymentId": "string",
    "readableCode": "string",
    "qrCode": "base64 string",
    "validUntil": "datetime",
    "personalAppLink": "link",
    "businessAppLink": "link",
    "corporateAppLink": "link"
}
```
- `paymentId` A unique identifier of the payment, used later to check the status.
- `readableCode` A payment code that the user can enter manually in case he cannot scan the QR code.
- `qrCode` A base64-encoded data URL of the QR code image that the user can scan with the FIB mobile app.
- `validUntil` an ISO-8601-formatted date-time string, representing a moment in time when the payment expires
- `personalAppLink` A link that the user can tap on his mobile phone to go to the corresponding payment screen in the FIB Personal app
- `businessAppLink` A link that the user can tap on his mobile phone to go to the corresponding payment screen in the FIB Business app
- `corporateAppLink`  A link that the user can tap on his mobile phone to go to the corresponding payment screen in the FIB Corporate app

#### Payment Status
```php
use Rawahamid\FibIntegration\Payments\FibPayment;

$response = FibPayment::status('payment-uuid');
```
Response structure will be: 
```json
{
  "paymentId": "string",
  "status": "string",
  "validUntil": "string",
  "amount": {
    "amount": "number",
    "currency": "string"
  },
  "decliningReason": "string",
  "declinedAt": "string",
  "paidBy": {
    "name": "string",
    "iban": "string"
  }
}
```
- `paymentId` A unique identifier of the payment, used later to check the status.
- `status` one of these values: `PAID` | `UNPAID` | `DECLINED`
- `validUntil` an ISO-8601-formatted date-time string, representing a moment in time when the payment expires
- `amount` contains payment amount and its currency
- `decliningReason` can be nullable or one of these values `SERVER_FAILURE` | `PAYMENT_EXPIRATION` | `PAYMENT_CANCELLATION`
- `declinedAt` datetime that represents the time of payment decline
- `paidBy` is nullable object if the payment is still not paid but if paid will contain the name and iban of the user

#### Payment Cancel
```php
use Rawahamid\FibIntegration\Payments\FibPayment;

$response = FibPayment::cancel('payment-uuid');
```
response will be empty if success

## IMPORTANT NOTE**
In every request of these if the response is 500 mean the creation, status or cancellation request something wrong happened

## License

The FIB Integration package is open source software licensed under the [License MIT](https://choosealicense.com/licenses/mit/)

## Contributing
Contributions are always welcome!

## Report & Feedback
If you face any problem feel free to contact me :) [rawahamid](mailto://rawahamid4321@gmail.com)
