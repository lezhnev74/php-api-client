<?php

namespace BitcoinPayGate\Response;

use BitcoinPayGate\APIResponse;

/**
 * Class PaymentReceipt represents response for payment status check.
 * @package BitcoinPayGate\Response
 */
class PaymentReceipt extends APIResponse
{
    /**
     * Payment available statuses.
     */
    const PAYMENT_STATUS_NEW = 'NEW';
    const PAYMENT_STATUS_PAID = 'PAID';
    const PAYMENT_STATUS_UNDERPAID = 'UNDERPAID';
    const PAYMENT_STATUS_CONFIRMED = 'CONFIRMED';
    const PAYMENT_STATUS_COMPLETED = 'COMPLETED';
    const PAYMENT_STATUS_EXPIRED = 'EXPIRED';
    const PAYMENT_STATUS_INVALID = 'INVALID';

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
     * @var string
     */
    protected $transactionId;

    /**
     * @var string
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var int
     */
    protected $expirationTime;

    /**
     * @var int
     */
    protected $currentTime;

    /**
     * @var string
     */
    protected $merchantTransactionId;

    /**
     * @var string
     */
    protected $transactionSpeed;

    /**
     * @var string
     */
    protected $notificationUrl;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $status;

    /**
     * Returns transaction id of payment receipt. A transaction identifier on BitcoinPayGate side,
     * for which the payment was made.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Returns amount of new payment receipt.
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Returns currency of new payment receipt, a ISO 4217 currency code of the currency.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Returns payment status of payment receipt.
     *
     * @return string
     */
    public function getPaymentStatus()
    {
        return $this->status;
    }

    /**
     * Returns expiration time of payment receipt. A String containing a UNIX timestamp in milliseconds format
     * saying when the payment will expire. This is only valid for NEW payments but is always present.
     *
     * @return int
     */
    public function getExpirationTime()
    {
        return (int)$this->expirationTime;
    }

    /**
     * Returns current time of payment receipt. A String containing a UNIX timestamp in milliseconds format
     * with the current server time.
     *
     * @return int
     */
    public function getCurrentTime()
    {
        return (int)$this->currentTime;
    }

    /**
     * Returns merchant transaction id of new payment receipt, which is an identifier for this payment
     * on the merchant side.
     *
     * @return string
     */
    public function getMerchantTransactionId()
    {
        return $this->merchantTransactionId;
    }

    /**
     * Returns transaction speed of new payment receipt.
     *
     * @return string
     */
    public function getTransactionSpeed()
    {
        return $this->transactionSpeed;
    }

    /**
     * Returns notification url of new payment receipt, which is a HTTPS URL where the payment notification will be send.
     *
     * @return string
     */
    public function getNotificationUrl()
    {
        return $this->notificationUrl;
    }

    /**
     * Returns message of payment receipt. This message should be saved by the client's wallet as a reminder
     * for what the payment was made
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Checks if payment is in NEW status.
     *
     * @return bool
     */
    public function isPaymentNew()
    {
        return $this->getPaymentStatus() == self::PAYMENT_STATUS_NEW;
    }

    /**
     * Checks if payment is in PAID status.
     *
     * @return bool
     */
    public function isPaymentPaid()
    {
        return $this->getPaymentStatus() == self::PAYMENT_STATUS_PAID;
    }

    /**
     * Checks if payment is in UNDERPAID status.
     *
     * @return bool
     */
    public function isPaymentUnderpaid()
    {
        return $this->getPaymentStatus() == self::PAYMENT_STATUS_UNDERPAID;
    }

    /**
     * Checks if payment is in CONFIRMED status.
     *
     * @return bool
     */
    public function isPaymentConfirmed()
    {
        return $this->getPaymentStatus() == self::PAYMENT_STATUS_CONFIRMED;
    }

    /**
     * Checks if payment is in COMPLETED status.
     *
     * @return bool
     */
    public function isPaymentCompleted()
    {
        return $this->getPaymentStatus() == self::PAYMENT_STATUS_COMPLETED;
    }

    /**
     * Checks if payment is in EXPIRED status.
     *
     * @return bool
     */
    public function isPaymentExpired()
    {
        return $this->getPaymentStatus() == self::PAYMENT_STATUS_EXPIRED;
    }

    /**
     * Checks if payment is in INVALID status.
     *
     * @return bool
     */
    public function isPaymentInvalid()
    {
        return $this->getPaymentStatus() == self::PAYMENT_STATUS_INVALID;
    }

    /**
     * {@inheritdoc}
     */
    protected function getSupportedFields()
    {
        return array(
            'transactionId',
            'amount',
            'currency',
            'status',
            'expirationTime',
            'currentTime',
            'merchantTransactionId',
            'transactionSpeed',
            'notificationUrl',
            'message',
        );
    }
}