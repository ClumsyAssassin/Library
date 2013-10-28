<?php

namespace Clumsy\Io\Reader;

use Clumsy\Io\Exception\EndOfFileException;
use Clumsy\Io\Exception\OpenFileException;
use Clumsy\Io\Exception\ReadFileException;
use Clumsy\Io\Exception\ResourceNotClosedException;
use Clumsy\Io\Exception\ResourceNotResetException;
use Clumsy\Io\Exception\ResourceSkipException;
use Clumsy\Utility\Assert;

/**
 * Class FileReader
 * @package Clumsy\Io\Reader
 */
class FileReader extends Reader
{
    /**
     * @param string $filename
     * @throws \Clumsy\Io\Exception\OpenFileException
     */
    public function __construct($filename)
    {
        Assert::assertFileIsReadable($filename);

        $this->_resource = fopen($filename, "r");
        if ($this->_resource === false)
            throw new OpenFileException("Filename: $filename");
    }

    public function __destruct()
    {
        if (isset($this->_resource) && is_resource($this->_resource))
            $this->close();
    }

    /**
     * @return string
     * @throws \Clumsy\Io\Exception\ReadFileException
     */
    public function readLine()
    {
        $this->_throwExceptionIfEndOfFile();

        $readString = fgets($this->_resource);
        if ($readString == false)
            throw new ReadFileException();

        return $readString;
    }

    /**
     * @return bool
     */
    protected function _isResourceAvailable()
    {
        return is_resource($this->_resource);
    }

    /**
     * @param int $length
     * @return string
     * @throws \Clumsy\Io\Exception\ReadFileException
     */
    protected function _read($length)
    {
        $this->_throwExceptionIfEndOfFile();
        $readString = fread($this->_resource, $length);

        if ($readString == false)
            throw new ReadFileException();

        return $readString;
    }

    /**
     * @param int $size
     * @throws \Clumsy\Io\Exception\ResourceSkipException
     */
    protected function _skip($size)
    {
        if (fseek($this->_resource, $size, SEEK_CUR) == -1)
            throw new ResourceSkipException();
    }

    /**
     * @throws \Clumsy\Io\Exception\ResourceNotResetException
     */
    protected function _reset()
    {
        if (!rewind($this->_resource))
            throw new ResourceNotResetException();
    }

    /**
     * @throws \Clumsy\Io\Exception\ResourceNotClosedException
     */
    protected function _close()
    {
        if (!fclose($this->_resource))
            throw new ResourceNotClosedException();
    }

    /**
     * @throws \Clumsy\Io\Exception\EndOfFileException
     */
    private function _throwExceptionIfEndOfFile()
    {
        if (feof($this->_resource))
            throw new EndOfFileException();
    }
}