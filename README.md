# Bitcoinpaygate API client for PHP

## Installation

Run following command To install stable version of API client for PHP:

```php
php composer.phar require bitcoinpaygate/php-api-client:1.0.*
```

For development purposes, you can download dev version of the library:

```php
php composer.phar require bitcoinpaygate/php-api-client:1.0.*@dev
```

## Usage

First of all, you should instantiate Client object:

```php
<?php

$httpClient = new \Buzz\Client\Curl();
$browser = new \Buzz\Browser($httpClient);

$client = new Client('https://testing.bitcoinpaygate.com/api/v1/', $apiKey, $browser);
```

### Creating new payment request

To create new payment request:

```php
<?php

// ... create client

$newPaymentRequest = new \BitcoinPayGate\Request\NewPaymentRequest();

$newPaymentRequest
    ->setAmount(...)
    ->setCurrency(...)
    ->setNotificationUrl(...)
    ->setTransactionSpeed(\BitcoinPayGate\Request\NewPaymentRequest::TRANSACTION_SPEED_HIGH)
    ->setMessage(...)
    ->setPaymentAckMessage(...)
    ->setMerchantTransactionId(...);

$newPaymentResponse = $client->processNewPayment($newPaymentRequest);
```

When your new payment request is invalid, e.g. no HTTPS notification url has been set, client will throw an exception.

### Checking payment receipt

To check current payment receipt:

```php
<?php

// ... create client

$paymentReceipt = $client->checkPaymentReceipt($transactionId());
```

### Requesting payment notification

To request payment notification:

```php
<?php

// ... create client

$requestNotificationResponse = $client->requestPaymentNotification($transactionId);
```

## Client development

If you want to extend client for another endpoint support, you have to:

- add associated test request/response classes,
- add associated test client classes.
- add new request class in \BitcoinPayGate\Request namespace,
- add new response class in \BitcoinPayGate\Response namespace (you can extend base API response class),
- extend client with new method.

After all, just run following command from library root directory:

```
phpunit
```

## Requirements

This library require following packages:

```
php5
php5-curl
php5-json
```