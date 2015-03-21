<?php

namespace BitcoinPayGate\Reponse;

use BitcoinPayGate\Response\RequestNotificationResponse;

/**
 * Class RequestNotificationResponseTest
 * @package BitcoinPayGate\Reponse
 */
class RequestNotificationResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testValidParameters()
    {
        $parameters =  array(
            'value' => 200,
        );

        $requestNotificationResponse = new RequestNotificationResponse($parameters);

        $this->assertEquals($parameters['value'], $requestNotificationResponse->getValue());
    }

    /**
     * @expectedException \BitcoinPayGate\Exception\InvalidDataStructureException
     */
    public function testNonExistingParameter()
    {
        $parameters = array(
            'foo' => 'bar',
        );

        $newPaymentResponse = new RequestNotificationResponse($parameters);
    }
}