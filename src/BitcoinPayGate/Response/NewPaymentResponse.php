<?php

namespace BitcoinPayGate\Response;

use BitcoinPayGate\APIResponse;

/**
 * Class NewPaymentResponse represents response for new payment request.
 * @package BitcoinPayGate\Payment
 */
class NewPaymentResponse extends APIResponse
{
    /**
     * @var string
     */
    protected $transactionId;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $paymentAddress;

    /**
     * @var int
     */
    protected $expirationTime;

    /**
     * @var string
     */
    protected $merchantTransactionId;

    /**
     * Returns transaction id of payment response. A transaction identifier on BitcoinPayGate side,
     * for which the payment was made.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Returns amount of new payment response.
     *
     * @return float
     */
    public function getAmount()
    {
        return (float)$this->amount;
    }

    /**
     * Returns address of new payment response. A Bitcoin address where the payment should be sent.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Returns label of new payment response. Identifier of the merchant (this is configurable in the dashboard).
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Sets message of new payment response. Says what the customer is paying for, this is coming from the message
     * field in the payment request.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Returns payment address of new payment response. A BIP21 formatted URL that is recognized by the
     * customer's Bitcoin wallet.
     *
     * @return string
     */
    public function getPaymentAddress()
    {
        return $this->paymentAddress;
    }

    /**
     * Returns expiration time of new payment response. A String containing a UNIX timestamp in milliseconds format
     * saying when the payment will expire. It can be displayed to the customer.
     *
     * @return int
     */
    public function getExpirationTime()
    {
        return (int)$this->expirationTime;
    }

    /**
     * Returns merchant transaction id of new payment response, which is an identifier for this payment
     * on the merchant side.
     *
     * @return string
     */
    public function getMerchantTransactionId()
    {
        return $this->merchantTransactionId;
    }

    /**
     * {@inheritdoc}
     */
    protected function getSupportedFields()
    {
        return array(
            'transactionId',
            'amount',
            'address',
            'label',
            'message',
            'paymentAddress',
            'expirationTime',
            'merchantTransactionId',
        );
    }
}