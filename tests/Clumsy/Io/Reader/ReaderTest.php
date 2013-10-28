<?php

class ReaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Clumsy\Io\Reader\Reader
     */
    private $_reader;

    public function setUp()
    {
        $this->_reader = $this->getMockForAbstractClass("Clumsy\Io\Reader\Reader");
    }

    public function testGetResource_WhenNotSet()
    {
        $this->setExpectedException("Clumsy\Exception\IsNotSetException");
        $this->_reader->getResource();
    }

    public function testRead_WhenNonIntGiven()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_reader->read(null);
    }

    public function testRead_WhenZeroGiven()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_reader->read(0);
    }

    public function testRead_WhenResourceNotAvailable()
    {
        $this->setExpectedException("Clumsy\Io\Exception\ResourceNotAvailableException");
        $this->_reader->read(5);
    }

    public function testRead_WhenResourceIsAvailable()
    {
        $this->_reader->expects($this->once())
            ->method("_isResourceAvailable")
            ->will($this->returnValue(true));

        $this->assertNull($this->_reader->read(10));
    }

    public function testSkip_WhenNonIntGiven()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_reader->skip(null);
    }

    public function testSkip_WhenNegativeGiven()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        $this->_reader->skip(-1);
    }

    public function testSkip_WhenResourceNotAvailable()
    {
        $this->setExpectedException("Clumsy\Io\Exception\ResourceNotAvailableException");
        $this->_reader->skip(5);
    }

    public function testSkip_WhenResourceIsAvailable()
    {
        $this->_reader->expects($this->once())
            ->method("_isResourceAvailable")
            ->will($this->returnValue(true));

        $this->assertNull($this->_reader->skip(10));
    }

    public function testReset_WhenResourceNotAvailable()
    {
        $this->setExpectedException("Clumsy\Io\Exception\ResourceNotAvailableException");
        $this->_reader->reset();
    }

    public function testReset_WhenResourceIsAvailable()
    {
        $this->_reader->expects($this->once())
            ->method("_isResourceAvailable")
            ->will($this->returnValue(true));

        $this->_reader->reset();
    }

    public function testClose_WhenResourceNotAvailable()
    {
        $this->setExpectedException("Clumsy\Io\Exception\ResourceNotAvailableException");
        $this->_reader->close();
    }

    public function testClose_WhenResourceIsAvailable()
    {
        $this->_reader->expects($this->once())
            ->method("_isResourceAvailable")
            ->will($this->returnValue(true));

        $this->_reader->close();
    }
}