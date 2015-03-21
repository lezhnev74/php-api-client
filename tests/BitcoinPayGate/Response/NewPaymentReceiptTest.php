<?php

namespace BitcoinPayGate\Reponse;

use BitcoinPayGate\Response\PaymentReceipt;

/**
 * Class NewPaymentReceiptTest
 * @package BitcoinPayGate\Reponse
 */
class NewPaymentReceiptTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testValidParameters()
    {
        $parameters =  array(
            'transactionId' => '95bf1d853cf2e040f0ce219221f9b17206525941',
            'amount' => '10.00',
            'currency' => 'USD',
            'status' => 'CONFIRMED',
            'paymentTime' => '1411421013977',
            'expirationTime' => '1411421014977',
            'currentTime' => '1411403014977',
            'merchantTransactionId' => '2015-03-10/123/1',
            'transactionSpeed' => 'LOW',
            'notificationUrl' => 'https=>//example.com/notify',
            'message' => 'payment for cookies',
        );

        $paymentReceipt = new PaymentReceipt($parameters);

        $this->assertEquals($parameters['transactionId'], $paymentReceipt->getTransactionId());
        $this->assertEquals($parameters['amount'], $paymentReceipt->getAmount());
        $this->assertEquals($parameters['currency'], $paymentReceipt->getCurrency());
        $this->assertEquals($parameters['status'], $paymentReceipt->getPaymentStatus());
        $this->assertEquals($parameters['expirationTime'], $paymentReceipt->getExpirationTime());
        $this->assertEquals($parameters['currentTime'], $paymentReceipt->getCurrentTime());
        $this->assertEquals($parameters['merchantTransactionId'], $paymentReceipt->getMerchantTransactionId());
        $this->assertEquals($parameters['transactionSpeed'], $paymentReceipt->getTransactionSpeed());
        $this->assertEquals($parameters['notificationUrl'], $paymentReceipt->getNotificationUrl());
        $this->assertEquals($parameters['message'], $paymentReceipt->getMessage());
    }

    /**
     * @expectedException \BitcoinPayGate\Exception\InvalidDataStructureException
     */
    public function testNonExistingParameter()
    {
        $parameters = array(
            'foo' => 'bar',
        );

        $newPaymentResponse = new PaymentReceipt($parameters);
    }
}