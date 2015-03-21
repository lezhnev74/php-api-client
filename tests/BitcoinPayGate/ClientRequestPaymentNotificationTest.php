<?php

namespace BitcoinPayGate;

use BitcoinPayGate\Response\PaymentReceipt;
use BitcoinPayGate\Response\RequestNotificationResponse;

/**
 * Class ClientRequestPaymentNotificationTest
 * @package BitcoinPayGate
 */
class ClientRequestPaymentNotificationTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testValidRequest()
    {
        $transactionId = '95bf1d853cf2e040f0ce219221f9b17206525941';
        $requestNotificationResponse = $this->client->requestPaymentNotification($transactionId);

        $this->assertTrue($requestNotificationResponse instanceof RequestNotificationResponse);
    }

    /**
     * @param $amount
     * @expectedException \BitcoinPayGate\Exception\InvalidDataException
     * @dataProvider invalidTransactionIdProvider
     */
    public function testInvalidTransactionId($transactionId)
    {
        $paymentReceiptResponse = $this->client->requestPaymentNotification($transactionId);
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
                'value' => 200,
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