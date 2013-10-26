<?php

namespace Clumsy\PoEdit;

use Clumsy\Utility\Assert;

/**
 * Class PluralMessage
 *
 * Represents a plural form message in a PoEdit file.
 *
 * @package Clumsy\PoEdit
 */
class PluralMessage extends Message
{
    /**
     * @var string $_pluralId
     */
    private $_pluralId;

    /**
     * @var int $_numberOfPluralForms
     */
    private $_numberOfPluralForms;

    /**
     * @var array $_messageList
     */
    private $_messageList = array();

    /**
     * @param string $messageId
     * @param string $pluralId
     * @param int $numberOfPluralForms
     */
    public function __construct($messageId, $pluralId, $numberOfPluralForms)
    {
        $this->setId($messageId);
        $this->setPluralId($pluralId);
        $this->_setNumberOfPluralForms($numberOfPluralForms);
    }

    /**
     * @param string $pluralId
     */
    public function setPluralId($pluralId)
    {
        Assert::assertString($pluralId);
        $this->_pluralId = $pluralId;
    }

    /**
     * @param int $numberOfPluralForms
     */
    protected function _setNumberOfPluralForms($numberOfPluralForms)
    {
        Assert::assertPositiveInt($numberOfPluralForms);

        for ($i = 0; $i < $numberOfPluralForms; $i++)
            $this->_messageList[] = '';

        $this->_numberOfPluralForms = $numberOfPluralForms;
    }

    /**
     * @return string
     */
    public function getPluralId()
    {
        return $this->_pluralId;
    }

    /**
     * @return int
     */
    public function getNumberOfPluralForms()
    {
        return $this->_numberOfPluralForms;
    }

    /**
     * @param string $message
     * @param int $index
     */
    public function setMessage($message, $index)
    {
        Assert::assertString($message);
        Assert::assertInt($index);
        Assert::assertIndexWithinBounds($index, 0, $this->_numberOfPluralForms - 1);
        $this->_messageList[$index] = $message;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->_messageList;
    }

    /**
     * @param int $index
     * @return string
     */
    public function getMessage($index)
    {
        Assert::assertInt($index);
        Assert::assertIndexWithinBounds($index, 0, $this->_numberOfPluralForms - 1);
        return $this->_messageList[$index];
    }
} 