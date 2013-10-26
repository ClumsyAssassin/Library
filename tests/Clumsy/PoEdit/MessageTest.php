<?php

class MessageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Clumsy\PoEdit\Message $_message ;
     */
    private $_message;

    public function setUp()
    {
        $this->_message = $this->getMockForAbstractClass("Clumsy\PoEdit\Message");
    }

    public function testSetFuzzy_WithBoolean()
    {
        $this->_message->setFuzzy(true);
        $this->assertAttributeEquals(true, '_fuzzy', $this->_message);
    }

    public function testSetFuzzy_WithInt()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_message->setFuzzy(1);
    }

    public function testIsFuzzy_ShouldNotBeFuzzyByDefault()
    {
        $this->assertFalse($this->_message->isFuzzy());
    }

    public function testGetComment_ShouldBeEmptyByDefault()
    {
        $this->assertEmpty($this->_message->getComment());
    }

    public function testSetComment_WhenStringPassed()
    {
        $this->_message->setComment("test comment");
        $this->assertAttributeEquals("test comment", "_comment", $this->_message);
    }

    public function testSetComment_WhenNullPassed()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_message->setComment(null);
    }

    public function testSetId_WithString()
    {
        $this->_message->setId("valid id");
        $this->assertAttributeEquals("valid id", "_id", $this->_message);
        return $this->_message;
    }

    public function testSetId_WithInt()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_message->setId(45);
    }

    public function testGetId_WhenNotSet()
    {
        $this->setExpectedException("Clumsy\Exception\IsNotSetException");
        $this->_message->getId();
    }

    /**
     * @depends testSetId_WithString
     * @param Clumsy\PoEdit\Message $message
     */
    public function testGetId_WhenSet($message)
    {
        $this->assertEquals("valid id", $message->getId());
    }
}