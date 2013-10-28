<?php

namespace Clumsy\Domain\Translation;

use Clumsy\Utility\Assert;

/**
 * Class SingularMessage
 * @package Clumsy\Domain\Translation
 */
class SingularMessage extends Message
{
    /**
     * @var string $_translatedMessage
     */
    private $_translatedMessage;

    /**
     * @param string $originalMessage
     * @param string $translatedMessage
     */
    public function __construct($originalMessage, $translatedMessage = "")
    {
        $this->setOriginalMessage($originalMessage);
        $this->setTranslatedMessage($translatedMessage);
    }

    /**
     * @param string $translatedMessage
     */
    public function setTranslatedMessage($translatedMessage)
    {
        Assert::assertString($translatedMessage);
        $this->_translatedMessage = $translatedMessage;
    }

    /**
     * @return string
     */
    public function getTranslatedMessage()
    {
        return $this->_translatedMessage;
    }
} 