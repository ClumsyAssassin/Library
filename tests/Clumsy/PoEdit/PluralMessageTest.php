<?php

use Clumsy\PoEdit\PluralMessage;

class PluralMessageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PluralMessage $_pluralMessage
     */
    private $_pluralMessage;

    public function setUp()
    {
        $this->_pluralMessage = new PluralMessage("messageId", "pluralId", 1);
    }

    public function testSetPluralId_WhenStringPassed()
    {
        $this->_pluralMessage->setPluralId("myId");
        $this->assertAttributeEquals("myId", "_pluralId", $this->_pluralMessage);
    }

    public function testSetPluralId_WhenNonStringPassed()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_pluralMessage->setPluralId(null);
    }

    public function testGetPluralId()
    {
        $this->assertEquals("pluralId", $this->_pluralMessage->getPluralId());
    }

    public function testGetNumberOfPluralForms()
    {
        $this->assertEquals(1, $this->_pluralMessage->getNumberOfPluralForms());
    }

    public function testSetMessage_WithMessageAndIndex()
    {
        $this->_pluralMessage->setMessage("my message", 0);
        $this->assertAttributeEquals(array("my message"), "_messageList", $this->_pluralMessage);
    }

    public function testSetMessage_WithANonStringMessage()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_pluralMessage->setMessage(null, 0);
    }

    public function testSetMessage_WithANonIntIndex()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_pluralMessage->setMessage("string", null);
    }

    public function testSetMessage_WhenIndexIsOutOfBounds()
    {
        $this->setExpectedException("Clumsy\Exception\OutOfBoundsException");
        $this->_pluralMessage->setMessage("string", -1);
    }

    public function testGetMessages()
    {
        $this->assertEquals(array(""), $this->_pluralMessage->getMessages());
    }

    public function testGetMessage_WithValidIndex()
    {
        $this->assertEquals("", $this->_pluralMessage->getMessage(0));
    }

    public function testGetMessage_WhenIndexNotInt()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_pluralMessage->getMessage(null);
    }

    public function testGetMessage_WhenIndexIsOutOfBounds()
    {
        $this->setExpectedException("Clumsy\Exception\OutOfBoundsException");
        $this->_pluralMessage->getMessage(-1);
    }

    //__construct($messageId, $pluralId, $numberOfPluralForms)
    public function testConstructor_WhenMessageIdNotString()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        new PluralMessage(true, "", 1);
    }

    public function testConstructor_WhenPluralIdNotString()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        new PluralMessage("", null, 1);
    }

    public function testConstructor_WhenNumberOfPluralFormsIsNotInt()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        new PluralMessage("", "", null);
    }

    public function testConstructor_WhenNumberOfPluralFormsIsNotPositive()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        new PluralMessage("", "", 0);
    }
}