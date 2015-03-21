<?php

namespace BitcoinPayGate\Response;

use BitcoinPayGate\APIResponse;

/**
 * Class RequestNotificationResponse represents response for request notification.
 * @package BitcoinPayGate\Response
 */
class RequestNotificationResponse extends APIResponse
{
    /**
     * @var int
     */
    protected $value;

    /**
     * Returns value.
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    protected function getSupportedFields()
    {
        return array(
            'value',
        );
    }
}