<?php

namespace BitcoinPayGate;

use BitcoinPayGate\Exception\InvalidDataException;
use BitcoinPayGate\Exception\InvalidRequestException;
use BitcoinPayGate\Exception\ServerException;
use BitcoinPayGate\Request\NewPaymentRequest;
use BitcoinPayGate\Response\NewPaymentResponse;
use BitcoinPayGate\Response\PaymentReceipt;
use BitcoinPayGate\Response\RequestNotificationResponse;
use Buzz\Browser;
use Buzz\Listener\BasicAuthListener;

/**
 * Class Client represents client for BitcoinPayGate API.
 * @package BitcoinPayGate
 */
class Client
{
    /**
     * Payments API endpoints.
     */
    const URL_PAYMENT_NEW = '/payments/new';
    const URL_PAYMENT_STATUS = '/payments/%s';
    const URL_PAYMENT_NOTIFICATION = '/payments/notify/%s';

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var Browser
     */
    protected $browser;

    /**
     * Constructor.
     *
     * @param $apiKey
     * @param Browser $httpClient
     * @param $baseUrl
     */
    public function __construct($apiKey, Browser $httpClient, $baseUrl = null)
    {
        $this->apiKey = $apiKey;
        $this->browser = $httpClient;

        if (empty($baseUrl)) {
            $baseUrl = 'https://testing.bitcoinpaygate.com/api/v1/';
        }

        $this->baseUrl = $baseUrl;

        $this->browser->addListener(new BasicAuthListener($this->apiKey, ''));
    }

    /**
     * Sends new payment request.
     *
     * @param NewPaymentRequest $newPaymentRequest
     * @return NewPaymentResponse
     * @throws InvalidDataException
     * @throws InvalidRequestException
     * @throws ServerException
     */
    public function processNewPayment(NewPaymentRequest $newPaymentRequest)
    {
        if (!is_numeric($newPaymentRequest->getAmount()) || $newPaymentRequest->getAmount() < 0) {
            throw new InvalidDataException('Invalid amount value');
        }

        if (!$newPaymentRequest->getCurrency()) {
            throw new InvalidDataException('No currency parameter');
        }

        if (!$newPaymentRequest->getNotificationUrl()) {
            throw new InvalidDataException('No notificationUrl parameter');
        } else {
            $parts = parse_url($newPaymentRequest->getNotificationUrl());

            if ($parts === false || !isset($parts['scheme']) || $parts['scheme'] != 'https') {
                throw new InvalidDataException('Invalid notificationUrl parameter');
            }
        }

        if (!$newPaymentRequest->getTransactionSpeed()) {
            throw new InvalidDataException('No transactionSpeed parameter');
        } elseif (!in_array($newPaymentRequest->getTransactionSpeed(), NewPaymentRequest::$TRANSACTION_SPEEDS)) {
            throw new InvalidDataException('Invalid transactionSpeed parameter');
        }

        if (!$newPaymentRequest->getMerchantTransactionId()) {
            throw new InvalidDataException('No merchantTransactionId parameter');
        }

        $response = $this->browser->post(
            $this->getUrl(self::URL_PAYMENT_NEW),
            array(
                'Content-Type' => 'application/json',
            ),
            json_encode(array(
                'amount' => (string)$newPaymentRequest->getAmount(),
                'currency' => $newPaymentRequest->getCurrency(),
                'notificationUrl' => $newPaymentRequest->getNotificationUrl(),
                'transactionSpeed' => $newPaymentRequest->getTransactionSpeed(),
                'message' => $newPaymentRequest->getMessage(),
                'paymentAckMessage' => $newPaymentRequest->getPaymentAckMessage(),
                'merchantTransactionId' => $newPaymentRequest->getMerchantTransactionId(),
            ))
        );

        if ($response->isClientError())  {
            throw new InvalidRequestException();
        } elseif ($response->isServerError()) {
            throw new ServerException();
        }

        return new NewPaymentResponse(json_decode($response->getContent(), true));
    }

    /**
     * Checks actual payment receipt.
     *
     * @param $transactionId
     * @return PaymentReceipt
     * @throws InvalidDataException
     * @throws InvalidRequestException
     * @throws ServerException
     */
    public function checkPaymentReceipt($transactionId)
    {
        if (!$transactionId) {
            throw new InvalidDataException('No transactionId parameter');
        }

        $response = $this->browser->get(
            $this->getUrl(self::URL_PAYMENT_STATUS, array($transactionId)),
            array(
                'Content-Type' => 'application/json',
            )
        );

        if ($response->isClientError())  {
            throw new InvalidRequestException();
        } elseif ($response->isServerError()) {
            throw new ServerException();
        }

        return new PaymentReceipt(json_decode($response->getContent(), true));
    }

    /**
     * Requests payment notification.
     *
     * @param $transactionId
     * @return RequestNotificationResponse
     * @throws InvalidDataException
     * @throws InvalidRequestException
     * @throws ServerException
     */
    public function requestPaymentNotification($transactionId)
    {
        if (!$transactionId) {
            throw new InvalidDataException('No transactionId parameter');
        }

        $response = $this->browser->get(
            $this->getUrl(self::URL_PAYMENT_NOTIFICATION, array($transactionId)),
            array(
                'Content-Type' => 'application/json',
            )
        );

        if ($response->isClientError())  {
            throw new InvalidRequestException();
        } elseif ($response->isServerError()) {
            throw new ServerException();
        }

        return new RequestNotificationResponse(json_decode($response->getContent(), true));
    }

    /**
     * Returns absolute URL address with given parameters.
     *
     * @param $action
     * @param $params
     * @return string
     */
    protected function getUrl($action, $params = array())
    {
        return vsprintf($this->baseUrl . $action, $params);
    }
}