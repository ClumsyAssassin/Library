<?php

class MessageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Clumsy\Domain\Translation\Message $_message
     */
    private $_message;

    public function setUp()
    {
        $this->_message = $this->getMockForAbstractClass("Clumsy\Domain\Translation\Message");
    }

    public function testSetOriginalMessage_WithAString()
    {
        $this->_message->setOriginalMessage("Simple String");
        $this->assertAttributeEquals("Simple String", "_original", $this->_message);
    }

    public function testSetOriginalMessage_WithNonString()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_message->setOriginalMessage(null);
    }

    public function testGetOriginalMessage()
    {
        $this->assertEquals("", $this->_message->getOriginalMessage());
    }

    public function testSetComment_WithAString()
    {
        $this->_message->setComment("Comment");
        $this->assertAttributeEquals("Comment", "_comment", $this->_message);
    }

    public function testSetComment_WithNonString()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_message->setComment(null);
    }

    public function testGetComment()
    {
        $this->assertEquals("", $this->_message->getComment());
    }

    public function testSetFuzzy_WithBoolean()
    {
        $this->_message->setFuzzy(true);
        $this->assertAttributeEquals(true, "_fuzzy", $this->_message);
    }

    public function testSetFuzzy_WithNonBoolean()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_message->setFuzzy(null);
    }

    public function testIsFuzzy()
    {
        $this->assertFalse($this->_message->isFuzzy());
    }
}