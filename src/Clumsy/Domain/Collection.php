<?php

namespace Clumsy\Domain;

use Clumsy\Utility\Assert;

/**
 * Class Collection
 * @package Clumsy\Domain
 */
class Collection extends \ArrayObject
{
    /**
     * @var string $_objectType
     */
    protected $_objectType = 'Clumsy\Domain\Base';

    public function __construct($input = array(), $flags = 0, $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
    }

    /**
     * @param mixed $index
     * @param mixed $value
     */
    public function offsetSet($index, $value)
    {
        $this->_assertValidType($value);
        parent::offsetSet($index, $value);
    }

    /**
     * @param mixed $value
     */
    public function append($value)
    {
        $this->_assertValidType($value);
        parent::append($value);
    }

    /**
     * @param array $input
     * @return array|void
     */
    public function exchangeArray($input)
    {
        Assert::assertArray($input);
        foreach ($input as $value)
            $this->_assertValidType($value);

        parent::exchangeArray($input);
    }

    /**
     * @param $value
     * @throws \Clumsy\Exception\InvalidArgumentException
     */
    private function _assertValidType($value)
    {
        Assert::assertInstanceOf($value, $this->_objectType);
    }
}