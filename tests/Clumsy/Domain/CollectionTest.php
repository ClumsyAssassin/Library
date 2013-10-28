<?php

use Clumsy\Domain\Collection;

class CollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Collection $_collection
     */
    private $_collection;

    public function setUp()
    {
        $this->_collection = new Collection();
    }

    public function testAddingToCollection_ProperClass()
    {
        $this->_collection[] = $this->getMock("Clumsy\Domain\Base");
    }

    public function testAddingToCollection_AtIntIndex()
    {
        $this->_collection[5] = $this->getMock("Clumsy\Domain\Base");
    }

    public function testAddingToCollection_KeyIndex()
    {
        $this->_collection["hello"] = $this->getMock("Clumsy\Domain\Base");
    }

    public function testAddingToCollection_IncorrectClass()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_collection[] = "not a base object";
    }

    public function testAppendingToCollection()
    {
        $this->_collection->append($this->getMock("Clumsy\Domain\Base"));
    }

    public function testAppendingToCollection_IncorrectClass()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_collection->append("not right object");
    }

    public function testExchangeArrayCollection()
    {
        $elements = array(
            $this->getMock("Clumsy\Domain\Base"),
            $this->getMock("Clumsy\Domain\Base"),
        );
        $this->_collection->exchangeArray($elements);
    }

    public function testExchangeArray_IncorrectClass()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $elements = array(
            $this->getMock("Clumsy\Domain\Base"),
            "Not a base object"
        );
        $this->_collection->exchangeArray($elements);
    }

    public function testExchangeArray_WhenNonArrayPassed()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_collection->exchangeArray("blah");
    }
}