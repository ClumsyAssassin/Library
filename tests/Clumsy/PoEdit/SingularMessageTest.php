<?php

use Clumsy\PoEdit\SingularMessage;

class SingularMessageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SingularMessage
     */
    private $_message;

    public function setUp()
    {
        $this->_message = new SingularMessage("testId");
    }

    public function testConstructor_WithMessageId()
    {
        $this->assertAttributeEquals("testId", "_id", $this->_message);
        $this->assertAttributeEmpty("_message", $this->_message);
    }

    public function testConstructor_WithMessageIdAndMessage()
    {
        $msg = new SingularMessage("testId", "test message");
        $this->assertAttributeEquals("testId", "_id", $msg);
        $this->assertAttributeEquals("test message", "_message", $msg);
    }

    public function testConstructor_WithMessageIdThatIsNotAString()
    {
        $this->setExpectedException("InvalidArgumentException");
        new SingularMessage(55);
    }

    public function testConstructor_WithMessageIdAndMessageStringThatIsNonString()
    {
        $this->setExpectedException("InvalidArgumentException");
        new SingularMessage("message id", null);
    }

    public function testSetMessage_WithAString()
    {
        $this->_message->setMessage("test");
        $this->assertAttributeEquals("test", "_message", $this->_message);
    }

    public function testSetMessage_WithANonString()
    {
        $this->setExpectedException("InvalidArgumentException");
        $this->_message->setMessage(null);
    }

    public function testGetMessage_WhenEmpty()
    {
        $this->assertEmpty($this->_message->getMessage());
    }
}
 