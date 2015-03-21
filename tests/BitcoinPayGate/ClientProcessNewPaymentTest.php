<?php

namespace BitcoinPayGate;

use BitcoinPayGate\Request\NewPaymentRequest;
use BitcoinPayGate\Response\NewPaymentResponse;

/**
 * Class ClientTest
 * @package BitcoinPayGate
 */
class ClientProcessNewPaymentTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testValidRequest()
    {
        $newPaymentRequest = $this->getNewPaymentRequest();

        $newPaymentRequest = $this->client->processNewPayment($newPaymentRequest);

        $this->assertTrue($newPaymentRequest instanceof NewPaymentResponse);
    }

    /**
     * @param $amount
     * @expectedException \BitcoinPayGate\Exception\InvalidDataException
     * @dataProvider invalidAmountProvider
     */
    public function testInvalidAmount($amount)
    {
        $newPaymentRequest = $this->getNewPaymentRequest();

        $newPaymentRequest->setAmount($amount);

        $this->client->processNewPayment($newPaymentRequest);
    }

    /**
     * @param $currency
     * @expectedException \BitcoinPayGate\Exception\InvalidDataException
     * @dataProvider invalidCurrencyProvider
     */
    public function testInvalidCurrency($currency)
    {
        $newPaymentRequest = $this->getNewPaymentRequest();

        $newPaymentRequest->setCurrency($currency);

        $this->client->processNewPayment($newPaymentRequest);
    }

    /**
     * @param $notificationUrl
     * @expectedException \BitcoinPayGate\Exception\InvalidDataException
     * @dataProvider invalidNotificationUrlProvider
     */
    public function testInvalidNotificationUrl($notificationUrl)
    {
        $newPaymentRequest = $this->getNewPaymentRequest();

        $newPaymentRequest->setNotificationUrl($notificationUrl);

        $this->client->processNewPayment($newPaymentRequest);
    }

    /**
     * @param $transactionSpeed
     * @expectedException \BitcoinPayGate\Exception\InvalidDataException
     * @dataProvider invalidTransactionSpeedProvider
     */
    public function testInvalidTransactionSpeed($transactionSpeed)
    {
        $newPaymentRequest = $this->getNewPaymentRequest();

        $newPaymentRequest->setTransactionSpeed($transactionSpeed);

        $this->client->processNewPayment($newPaymentRequest);
    }

    /**
     * @param $amount
     * @expectedException \BitcoinPayGate\Exception\InvalidDataException
     * @dataProvider invalidMerchantTransactionIdProvider
     */
    public function testInvalidMerchantTransactionId($merchantTransactionId)
    {
        $newPaymentRequest = $this->getNewPaymentRequest();

        $newPaymentRequest->setMerchantTransactionId($merchantTransactionId);

        $this->client->processNewPayment($newPaymentRequest);
    }

    /**
     *
     */
    public function invalidAmountProvider()
    {
        return array(
            array(null),
            array(-1),
            array(-0.02),
            array('abc'),
        );
    }

    /**
     *
     */
    public function invalidCurrencyProvider()
    {
        return array(
            array(null),
        );
    }

    /**
     *
     */
    public function invalidNotificationUrlProvider()
    {
        return array(
            array(null),
            array('http://127.0.0.1'),
            array('https://'),
            array(1234),
            array('abc'),
        );
    }

    /**
     *
     */
    public function invalidTransactionSpeedProvider()
    {
        return array(
            array(null),
            array(1234),
            array('abc'),
        );
    }

    /**
     *
     */
    public function invalidMerchantTransactionIdProvider()
    {
        return array(
            array(null),
            array(''),
        );
    }

    /**
     * @return NewPaymentRequest
     */
    protected function getNewPaymentRequest()
    {
        $newPaymentRequest = new NewPaymentRequest();

        $newPaymentRequest
            ->setAmount(0.04)
            ->setCurrency('USD')
            ->setNotificationUrl('https://127.0.0.1/notify')
            ->setTransactionSpeed('HIGH')
            ->setMessage('test payment')
            ->setPaymentAckMessage('test payment ack message')
            ->setMerchantTransactionId('999-testing');

        return $newPaymentRequest;
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
                'amount' => '0.03444190',
                'address' => 'mjSk1Ny9spzU2fouzYgLqGUD8U41iR35QN',
                'label'  => 'Your store name',
                'message'  => 'Order of flowers and chocolates',
                'paymentAddress' => 'bitcoin:mjSk1Ny9spzU2fouzYgLqGUD8U41iR35QN?amount=0.03444190&label=Your+store+name&message=Order+of+flowers+%26+chocolates',
                'expirationTime'=> '1424273503000',
                'merchantTransactionId' => '2015-03-10/123/1',
            ))));
        $browser
            ->expects($this->any())
            ->method('post')
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