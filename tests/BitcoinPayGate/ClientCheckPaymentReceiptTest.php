<?php

namespace BitcoinPayGate;

use BitcoinPayGate\Response\PaymentReceipt;

/**
 * Class ClientCheckPaymentReceiptTest
 * @package BitcoinPayGate
 */
class ClientCheckPaymentReceiptTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testValidRequest()
    {
        $transactionId = '95bf1d853cf2e040f0ce219221f9b17206525941';
        $paymentReceiptResponse = $this->client->checkPaymentReceipt($transactionId);

        $this->assertTrue($paymentReceiptResponse instanceof PaymentReceipt);
        $this->assertEquals($transactionId, $paymentReceiptResponse->getTransactionId());
    }

    /**
     * @param $amount
     * @expectedException \BitcoinPayGate\Exception\InvalidDataException
     * @dataProvider invalidTransactionIdProvider
     */
    public function testInvalidTransactionId($transactionId)
    {
        $paymentReceiptResponse = $this->client->checkPaymentReceipt($transactionId);
    }

    /**
     *
     */
    public function invalidTransactionIdProvider()
    {
        return array(
            array(null),
            array(''),
        );
    }

    /**
     *
     */
    protected function setUp()
    {
        $browser = $this->getMock('\Buzz\Browser');;
        $response = $this->getMock('\Buzz\Message\Response');

        $response
            ->expects($this->any())
            ->method('isClientError')
            ->will($this->returnValue(false));
        $response
            ->expects($this->any())
            ->method('isServerError')
            ->will($this->returnValue(false));
        $response
            ->expects($this->any())
            ->method('getContent')
            ->will($this->returnValue(json_encode(array(
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
            ))));
        $browser
            ->expects($this->any())
            ->method('get')
            ->will($this->returnValue($response));

        $this->client = new Client('API_SECRET_KEY', $browser, 'URL');
    }

    /**
     *
     */
    protected function tearDown()
    {
        unset($this->client);
    }
}