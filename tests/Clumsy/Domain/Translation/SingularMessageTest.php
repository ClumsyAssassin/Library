<?php

use Clumsy\Domain\Translation\SingularMessage;

class SingularMessageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Clumsy\Domain\Translation\SingularMessage
     */
    private $_message;

    public function setUp()
    {
        $this->_message = new SingularMessage("original");
    }

    public function testConstructor_WithNonString()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        new SingularMessage(null);
    }

    public function testConstructor_WithBothParameters()
    {
        new SingularMessage("original", "translation");
    }

    public function testConstructor_WithTranslatedParamNotAString()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        new SingularMessage("original", null);
    }

    public function testSetTranslatedMessage_WithNonString()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_message->setTranslatedMessage(null);
    }

    public function testSetTranslatedMessage_WithString()
    {
        $this->_message->setTranslatedMessage("hello");
        $this->assertAttributeEquals("hello", "_translatedMessage", $this->_message);
    }

    public function testGetTranslatedMessage()
    {
        $this->assertEquals("", $this->_message->getTranslatedMessage());
    }
}