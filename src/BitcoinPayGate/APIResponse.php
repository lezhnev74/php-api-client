<?php

namespace BitcoinPayGate;

use BitcoinPayGate\Exception\InvalidDataStructureException;

/**
 * Class APIResponse represents general response from an API.
 * @package BitcoinPayGate
 */
abstract class APIResponse implements \Serializable
{
    /**
     * Constructor.
     *
     * Binds all given parameters to class attributes.
     *
     * @param array $params
     * @throws InvalidDataStructureException
     */
    public function __construct(array $params)
    {
        foreach ($this->getSupportedFields() as $name) {
            if (in_array($name, array_keys($params))) {
                $this->{$name} = $params[$name];
            } else {
                throw new InvalidDataStructureException('Invalid payment status data');
            }
        }
    }

    /**
     * Returns serialized representation of the attributes.
     *
     * @return string
     */
    public function serialize() {
        $data = array();

        foreach ($this->getSupportedFields() as $name) {
            $data[$name] = $this->{$name};
        }

        return serialize($data);
    }

    /**
     * Sets object attributes from unserialized parameters.
     *
     * @param $data
     */
    public function unserialize($data) {
        $data = unserialize($data);

        foreach ($this->getSupportedFields() as $name) {
            if (in_array($name, array_keys($data))) {
                $this->{$name} = $data[$name];
            }
        }
    }

    /**
     * Returns array of class attributes, corresponding to API response fields.
     *
     * @return array
     */
    abstract protected function getSupportedFields();
}