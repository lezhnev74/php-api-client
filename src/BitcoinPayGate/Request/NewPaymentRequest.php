<?php

namespace BitcoinPayGate\Request;

/**
 * Class NewPaymentRequest represents single request for new payment.
 * @package BitcoinPayGate\Request
 */
class NewPaymentRequest
{
    /**
     * Payment transaction speeds.
     */
    const TRANSACTION_SPEED_LOW = 'LOW';
    const TRANSACTION_SPEED_MEDIUM = 'MEDIUM';
    const TRANSACTION_SPEED_HIGH = 'HIGH';

    /**
     * Available payment transaction speeds.
     *
     * @var array
     */
    public static $TRANSACTION_SPEEDS = array(
        self::TRANSACTION_SPEED_LOW,
        self::TRANSACTION_SPEED_MEDIUM,
        self::TRANSACTION_SPEED_HIGH,
    );

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $notificationUrl;

    /**
     * @var string
     */
    protected $transactionSpeed;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $paymentAckMessage;

    /**
     * @var string
     */
    protected $merchantTransactionId;

    /**
     * Returns amount of new payment request.
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Sets amount of new payment request.
     *
     * @param $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Returns currency of new payment request, a ISO 4217 currency code of the currency.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Sets currency of new payment request, a ISO 4217 currency code of the currency.
     *
     * @param $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Returns notification url of new payment request, which is a HTTPS URL where the payment notification will be send.
     *
     * @return string
     */
    public function getNotificationUrl()
    {
        return $this->notificationUrl;
    }

    /**
     * Sets notification url of new payment request, which is a HTTPS URL where the payment notification will be send.
     *
     * @param $notificationUrl
     * @return $this
     */
    public function setNotificationUrl($notificationUrl)
    {
        $this->notificationUrl = $notificationUrl;

        return $this;
    }

    /**
     * Returns transaction speed of new payment request.
     *
     * @return string
     */
    public function getTransactionSpeed()
    {
        return $this->transactionSpeed;
    }

    /**
     * Sets transaction speed of new payment request.
     *
     * @param $transactionSpeed
     * @return $this
     */
    public function setTransactionSpeed($transactionSpeed)
    {
        $this->transactionSpeed = $transactionSpeed;

        return $this;
    }

    /**
     * Returns message of new payment request. This will be displayed in the customers' Bitcoin
     * wallet application when requesting the payment.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets message of new payment request. This will be displayed in the customers' Bitcoin
     * wallet application when requesting the payment.
     *
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Returns payment ack message of new payment request. This will be displayed to the client in the Bitcoin
     * wallet application when BitCoinPayGate confirms the payment - this is currently not used.
     *
     * @return string
     */
    public function getPaymentAckMessage()
    {
        return $this->paymentAckMessage;
    }

    /**
     * Sets payment ack message of new payment request. This will be displayed to the client in the Bitcoin
     * wallet application when BitCoinPayGate confirms the payment - this is currently not used.
     *
     * @param $paymentAckMessage
     * @return $this
     */
    public function setPaymentAckMessage($paymentAckMessage)
    {
        $this->paymentAckMessage = $paymentAckMessage;

        return $this;
    }

    /**
     * Returns merchant transaction id of new payment request, which is an identifier for this payment
     * on the merchant side.
     *
     * @return string
     */
    public function getMerchantTransactionId()
    {
        return $this->merchantTransactionId;
    }

    /**
     * Sets merchant transaction id of new payment request, which is an identifier for this payment
     * on the merchant side.
     *
     * @param $merchantTransactionId
     * @return $this
     */
    public function setMerchantTransactionId($merchantTransactionId)
    {
        $this->merchantTransactionId = $merchantTransactionId;

        return $this;
    }
}