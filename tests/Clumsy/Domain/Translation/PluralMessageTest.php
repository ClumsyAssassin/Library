<?php

use Clumsy\Domain\Translation\PluralMessage;

class PluralMessageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Clumsy\Domain\Translation\PluralMessage $_pluralMessage
     */
    private $_pluralMessage;

    public function setUp()
    {
        $this->_pluralMessage = new PluralMessage("original", "plural", 1);
    }

    public function testConstruct_OriginalMessageNotString()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        new PluralMessage(null, "", 1);
    }

    public function testConstruct_PluralMessageNotString()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        new PluralMessage("", null, 1);
    }

    public function testConstruct_NumberOfPluralsNotInt()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        new PluralMessage("", "", null);
    }

    public function testConstruct_NumberOfPluralsZero()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        new PluralMessage("", "", 0);
    }

    public function testSetOriginalPluralMessage()
    {
        $this->_pluralMessage->setOriginalPluralMessage("myPlural");
        $this->assertAttributeEquals("myPlural", "_originalPluralMessage", $this->_pluralMessage);
    }

    public function testSetOriginalPluralMessage_WithNonString()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_pluralMessage->setOriginalPluralMessage(null);
    }

    public function testGetOriginalPluralMessage()
    {
        $this->assertEquals("plural", $this->_pluralMessage->getOriginalPluralMessage());
    }

    public function testGetNumPluralForms()
    {
        $this->assertEquals(1, $this->_pluralMessage->getNumPluralForms());
    }

    public function testSetTranslationMessage_WithStringAndIndex()
    {
        $this->_pluralMessage->setTranslationMessage("test", 0);
        $this->assertAttributeEquals(array("test"), "_translationMessages", $this->_pluralMessage);
    }

    public function testSetTranslationMessage_WithStringAndNonInt()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_pluralMessage->setTranslationMessage("", null);
    }

    public function testSetTranslationMessage_WithNonString()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_pluralMessage->setTranslationMessage(null, 0);
    }

    public function testSetTranslationMessage_WithStringAndOutOfBoundsInt()
    {
        $this->setExpectedException("Clumsy\Exception\OutOfBoundsException");
        $this->_pluralMessage->setTranslationMessage("", 6);
    }

    public function testGetTranslatedMessage()
    {
        $this->assertEquals("", $this->_pluralMessage->getTranslationMessage(0));
    }

    public function testGetTranslatedMessage_NonIntPassed()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_pluralMessage->getTranslationMessage(null);
    }

    public function testGetTranslatedMessage_IndexOutOfBounds()
    {
        $this->setExpectedException("Clumsy\Exception\OutOfBoundsException");
        $this->_pluralMessage->getTranslationMessage(5);
    }
}