<?php

namespace Clumsy\Domain\Translation;

use Clumsy\Domain\Base;
use Clumsy\Utility\Assert;

/**
 * Class Message
 * @package Clumsy\Domain\Translation
 */
abstract class Message extends Base
{
    /**
     * @var bool $_fuzzy
     */
    private $_fuzzy = false;

    /**
     * @var string $_comment
     */
    private $_comment = "";

    /**
     * @var string $_original
     */
    private $_original = "";

    /**
     * @param string $original
     */
    public function setOriginalMessage($original)
    {
        Assert::assertString($original);
        $this->_original = $original;
    }

    /**
     * @return string
     */
    public function getOriginalMessage()
    {
        return $this->_original;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        Assert::assertString($comment);
        $this->_comment = $comment;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->_comment;
    }

    /**
     * @param bool $fuzzy
     */
    public function setFuzzy($fuzzy)
    {
        Assert::assertBool($fuzzy);
        $this->_fuzzy = $fuzzy;
    }

    /**
     * @return bool
     */
    public function isFuzzy()
    {
        return $this->_fuzzy;
    }
} 