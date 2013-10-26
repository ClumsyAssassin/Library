<?php

namespace Clumsy\PoEdit;

use Clumsy\Utility\Assert;

/**
 * Class SingularMessage
 *
 * Represents a singular message in a PoEdit file.  The singular form has a message id and a
 * translation called the message.
 *
 * @package Clumsy\PoEdit
 */
class SingularMessage extends Message
{
    /**
     * @var string
     */
    private $_message;

    /**
     * @param string $messageId
     * @param string $message
     */
    public function __construct($messageId, $message = '')
    {
        $this->setId($messageId);
        $this->setMessage($message);
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        Assert::assertString($message);
        $this->_message = $message;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->_message;
    }
} 