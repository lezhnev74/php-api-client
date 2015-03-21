<?php

namespace BitcoinPayGate\Reponse;

use BitcoinPayGate\Response\NewPaymentResponse;

/**
 * Class NewPaymentResponseTest
 * @package BitcoinPayGate\Reponse
 */
class NewPaymentResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testValidParameters()
    {
        $parameters =  array(
            'transactionId' => '95bf1d853cf2e040f0ce219221f9b17206525941',
            'amount' => '0.03444190',
            'address' => 'mjSk1Ny9spzU2fouzYgLqGUD8U41iR35QN',
            'label'  => 'Your store name',
            'message'  => 'Order of flowers and chocolates',
            'paymentAddress' => 'bitcoin:mjSk1Ny9spzU2fouzYgLqGUD8U41iR35QN?amount=0.03444190&label=Your+store+name&message=Order+of+flowers+%26+chocolates',
            'expirationTime'=> '1424273503000',
            'merchantTransactionId' => '2015-03-10/123/1',
        );

        $newPaymentResponse = new NewPaymentResponse($parameters);

        $this->assertEquals($parameters['transactionId'], $newPaymentResponse->getTransactionId());
        $this->assertEquals($parameters['amount'], $newPaymentResponse->getAmount());
        $this->assertEquals($parameters['address'], $newPaymentResponse->getAddress());
        $this->assertEquals($parameters['label'], $newPaymentResponse->getLabel());
        $this->assertEquals($parameters['message'], $newPaymentResponse->getMessage());
        $this->assertEquals($parameters['paymentAddress'], $newPaymentResponse->getPaymentAddress());
        $this->assertEquals($parameters['expirationTime'], $newPaymentResponse->getExpirationTime());
        $this->assertEquals($parameters['merchantTransactionId'], $newPaymentResponse->getMerchantTransactionId());
    }

    /**
     * @expectedException \BitcoinPayGate\Exception\InvalidDataStructureException
     */
    public function testNonExistingParameter()
    {
        $parameters = array(
            'foo' => 'bar',
        );

        $newPaymentResponse = new NewPaymentResponse($parameters);
    }
}