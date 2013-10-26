<?php

namespace Clumsy\PoEdit;

use Clumsy\Exception\IsNotSetException;
use Clumsy\Utility\Assert;

/**
 * Class Message
 *
 * A PoEdit Message is a single message in a PoEdit file.  All messages in PoEdit contain a message id, an optional
 * comment, and an optional flag called fuzzy.  Fuzzy simple flags if a message is a fuzzy translation.
 *
 * @author Robert Burnfield
 * @package Clumsy\PoEdit
 */
abstract class Message
{
    /**
     * @var string $_id
     */
    private $_id;

    /**
     * @var string $_comment
     */
    private $_comment = '';

    /**
     * @var bool $_fuzzy
     */
    private $_fuzzy = false;

    /**
     * @param string $id
     */
    public function setId($id)
    {
        Assert::assertString($id);
        $this->_id = $id;
    }

    /**
     * @return string
     * @throws IsNotSetException
     */
    public function getId()
    {
        Assert::assertIsSet($this->_id);
        return $this->_id;
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