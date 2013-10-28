<?php

namespace Clumsy\Io\Reader;

use Clumsy\Io\Closeable;
use Clumsy\Io\Exception\ResourceNotAvailableException;
use Clumsy\Utility\Assert;

/**
 * Class Reader
 * @package Clumsy\Io\Reader
 */
abstract class Reader implements Closeable
{
    /**
     * @var mixed $_resource The resource that is being read from
     */
    protected $_resource;

    /**
     * @return mixed
     */
    public function getResource()
    {
        Assert::assertIsSet($this->_resource);
        return $this->_resource;
    }

    /**
     * @param int $length
     * @return string
     */
    public function read($length)
    {
        Assert::assertPositiveInt($length);
        $this->_throwExceptionIfResourceNotAvailable();
        return $this->_read($length);
    }

    /**
     * @param int $size
     */
    public function skip($size)
    {
        Assert::assertNonNegativeInt($size);
        $this->_throwExceptionIfResourceNotAvailable();
        $this->_skip($size);
    }

    public function reset()
    {
        $this->_throwExceptionIfResourceNotAvailable();
        $this->_reset();
    }

    public function close()
    {
        $this->_throwExceptionIfResourceNotAvailable();
        $this->_close();
    }

    /**
     * @throws ResourceNotAvailableException
     */
    protected function _throwExceptionIfResourceNotAvailable()
    {
        if (!$this->_isResourceAvailable())
            throw new ResourceNotAvailableException();
    }

    /**
     * @return bool
     */
    abstract protected function _isResourceAvailable();

    /**
     * @param int $length
     * @return string
     */
    abstract protected function _read($length);

    /**
     * @param int $size
     */
    abstract protected function _skip($size);

    abstract protected function _reset();

    abstract protected function _close();
} 