<?php

use \org\bovigo\vfs\vfsStream;
use \Clumsy\Io\Reader\FileReader;

class FileReaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory $_root
     */
    private $_root;

    /**
     * @var \org\bovigo\vfs\vfsStreamFile $_file
     */
    private $_file;

    /**
     * @var FileReader $_reader
     */
    private $_reader;

    public function setUp()
    {
        $content = "test line 1\n"
            . "test line 2\n"
            . "test line 3";

        $this->_root = vfsStream::setup("test");
        $this->_file = vfsStream::newFile("file.txt");
        $this->_file->setContent($content);
        $this->_root->addChild($this->_file);
        $this->_reader = new FileReader(vfsStream::url("test/file.txt"));
    }

    public function testConstructor_FileNotExist()
    {
        $this->setExpectedException("Clumsy\Exception\FileNotFoundException");
        new FileReader(vfsStream::url("test/nonExistent.txt"));
    }

    public function testConstructor_FileNotReadable()
    {
        $this->setExpectedException("Clumsy\Exception\FileNotReadableException");
        $this->_root->addChild(vfsStream::newFile("notReadable.txt", 0));
        new FileReader(vfsStream::url("test/notReadable.txt"));
    }

    public function testConstructor_FileIsDir()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException");
        new FileReader(vfsStream::url("test"));
    }

    public function testGetResource()
    {
        $this->assertInternalType('resource', $this->_reader->getResource());
    }

    public function testRead_ReadSomeBytes()
    {
        $this->assertEquals("test line 1", $this->_reader->read(11));
    }

    public function testRead_ReadMoreBytesThanInFile()
    {
        $this->setExpectedException("Clumsy\Io\Exception\EndOfFileException");
        $this->_file->seek(700, 0);
        $this->_reader->read(50);
    }

    public function testSkip_SkipAndCheckRead()
    {
        $this->_reader->skip(4);
        $this->assertEquals(4, $this->_file->getBytesRead());
    }

    public function testReset_MovesBackToBeginningOfFile()
    {
        $this->_file->seek(12, 0);
        $this->assertEquals("test line 2", $this->_file->read(11));
        $this->_reader->reset();
        $this->assertEquals("test line 1", $this->_file->read(11));
    }

    /**
     * @depends testRead_ReadSomeBytes
     */
    public function testClose_VerifyResourceIsClosed()
    {
        $this->setExpectedException("Clumsy\Io\Exception\ResourceNotAvailableException");
        $this->_reader->close();
        $this->_reader->read(10);
    }

    public function testReadLine_WhenLineAvailable()
    {
        $this->assertEquals("test line 1\n", $this->_reader->readLine());
    }

    public function testReadLine_WhenEndOfFileReached()
    {
        $this->setExpectedException("Clumsy\Io\Exception\EndOfFileException");
        $this->_file->seek(600, 0);
        $this->_reader->readLine();
    }
}