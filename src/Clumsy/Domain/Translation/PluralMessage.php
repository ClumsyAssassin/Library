<?php

namespace Clumsy\Domain\Translation;

use Clumsy\Utility\Assert;

/**
 * Class PluralMessage
 * @package Clumsy\Domain\Translation
 */
class PluralMessage extends Message
{
    /**
     * @var string $_originalPluralMessage
     */
    private $_originalPluralMessage;

    /**
     * @var string[] $_translationMessages
     */
    private $_translationMessages;

    /**
     * @var int $_numPluralForms
     */
    private $_numPluralForms;

    /**
     * @param string $originalMessage
     * @param string $originalPluralMessage
     * @param int $numPluralForms
     */
    public function __construct($originalMessage, $originalPluralMessage, $numPluralForms)
    {
        $this->setOriginalMessage($originalMessage);
        $this->setOriginalPluralMessage($originalPluralMessage);
        $this->_setNumPluralForms($numPluralForms);
        $this->_initTranslationMessages();
    }

    /**
     * @param string $originalPluralMessage
     */
    public function setOriginalPluralMessage($originalPluralMessage)
    {
        Assert::assertString($originalPluralMessage);
        $this->_originalPluralMessage = $originalPluralMessage;
    }

    /**
     * @return string
     */
    public function getOriginalPluralMessage()
    {
        return $this->_originalPluralMessage;
    }

    /**
     * @return int
     */
    public function getNumPluralForms()
    {
        return $this->_numPluralForms;
    }

    /**
     * @param string $translation
     * @param int $index
     */
    public function setTranslationMessage($translation, $index)
    {
        Assert::assertString($translation);
        Assert::assertIndexWithinBounds($index, 0, $this->_numPluralForms - 1);
        $this->_translationMessages[$index] = $translation;
    }

    /**
     * @param int $index
     * @return string
     */
    public function getTranslationMessage($index)
    {
        Assert::assertIndexWithinBounds($index, 0, $this->_numPluralForms - 1);
        return $this->_translationMessages[$index];
    }

    /**
     * @param int $pluralForms
     */
    protected function _setNumPluralForms($pluralForms)
    {
        Assert::assertPositiveInt($pluralForms);
        $this->_numPluralForms = $pluralForms;
    }

    private function _initTranslationMessages()
    {
        for ($i = 0; $i < $this->_numPluralForms; $i++)
            $this->_translationMessages[$i] = "";
    }
} 