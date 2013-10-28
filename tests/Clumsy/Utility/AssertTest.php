<?php

use Clumsy\Utility\Assert;
use org\bovigo\vfs\vfsStream;

class AssertTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    private $_root;

    public function setUp()
    {
        $this->_root = vfsStream::setup("test");
    }

    public function testAssertString_WhenStringPassed()
    {
        Assert::assertString("This is a valid string.");
    }

    public function testAssertString_WhenEmptyStringAssertPassed()
    {
        Assert::assertString("");
    }

    public function testAssertString_WhenIntStringAssertPassed()
    {
        Assert::assertString("1");
    }

    public function testAssertString_WhenIntegerPassed()
    {
        $this->_setExpectedInvalidArgumentException(1, 'string', 'integer');
        Assert::assertString(1);
    }

    public function testAssertString_WhenNullPassed()
    {
        $this->_setExpectedInvalidArgumentException(null, 'string', 'NULL');
        Assert::assertString(null);
    }

    public function testAssertBool_WhenBoolPassed()
    {
        Assert::assertBool(true);
        Assert::assertBool(false);
    }

    public function testAssertBool_WhenIntegerPassed()
    {
        $this->_setExpectedInvalidArgumentException(1, 'bool', 'integer');
        Assert::assertBool(1);
    }

    public function testAssertBool_WhenNullPassed()
    {
        $this->_setExpectedInvalidArgumentException(null, 'bool', 'NULL');
        Assert::assertBool(null);
    }

    public function testAssertInt_WhenIntPassed()
    {
        Assert::assertInt(1);
    }

    public function testAssertInt_WhenStringIntPassed()
    {
        $this->_setExpectedInvalidArgumentException("1", 'int', 'string');
        Assert::assertInt("1");
    }

    public function testAssertInt_WhenStringPassed()
    {
        $this->_setExpectedInvalidArgumentException("This is a string", 'int', 'string');
        Assert::assertInt("This is a string");
    }

    public function testAssertInt_WhenFloatPassed()
    {
        $this->_setExpectedInvalidArgumentException(1.0, 'int', 'double');
        Assert::assertInt(1.0);
    }

    public function testAssertInt_WhenNullPassed()
    {
        $this->_setExpectedInvalidArgumentException(null, 'int', 'NULL');
        Assert::assertInt(null);
    }

    public function testAssertInt_WhenBoolPassed()
    {
        $this->_setExpectedInvalidArgumentException(true, 'int', 'boolean');
        Assert::assertInt(true);
    }

    public function testAssertPositiveNumber_WhenFloatOrIntPassed()
    {
        Assert::assertPositiveNumber(0.1);
        Assert::assertPositiveNumber(1);
    }

    public function testAssertPositiveNumber_WhenNegativeNumberPassed()
    {
        $this->_setExpectedInvalidArgumentException(-0.1, 'positive number');
        Assert::assertPositiveNumber(-0.1);
    }

    public function testAssertPositiveNumber_WhenZeroPassed()
    {
        $this->_setExpectedInvalidArgumentException(0, 'positive number');
        Assert::assertPositiveNumber(0);
    }

    public function testAssertPositiveNumber_WhenBoolPassed()
    {
        $this->_setExpectedInvalidArgumentException(true, 'number', 'boolean');
        Assert::assertPositiveNumber(true);
    }

    public function testAssertNumber_WhenIntOrFloatPassed()
    {
        Assert::assertNumber(1);
        Assert::assertNumber(0.4);
        Assert::assertNumber(-1.6);
    }

    public function testAssertNumber_WhenBoolPassed()
    {
        $this->_setExpectedInvalidArgumentException(true, 'number', 'boolean');
        Assert::assertNumber(true);
    }

    public function testAssertNumber_WhenNullPassed()
    {
        $this->_setExpectedInvalidArgumentException(null, 'number', 'NULL');
        Assert::assertNumber(null);
    }

    public function testAssertPositiveInt_WhenPositiveIntPassed()
    {
        Assert::assertPositiveInt(1);
    }

    public function testAssertPositiveInt_WhenPositiveFloatPassed()
    {
        $this->_setExpectedInvalidArgumentException(0.1, 'int', 'double');
        Assert::assertPositiveInt(0.1);
    }

    public function testAssertPositiveInt_WhenNegativeIntPassed()
    {
        $this->_setExpectedInvalidArgumentException(-1, 'positive number');
        Assert::assertPositiveInt(-1);
    }

    public function testAssertPositiveInt_WhenZeroPassed()
    {
        $this->_setExpectedInvalidArgumentException(0, 'positive number');
        Assert::assertPositiveInt(0);
    }

    public function testAssertPositiveInt_WhenNullPassed()
    {
        $this->_setExpectedInvalidArgumentException(null, 'int', 'NULL');
        Assert::assertPositiveInt(null);
    }

    public function testAssertPositiveInt_WhenBoolPassed()
    {
        $this->_setExpectedInvalidArgumentException(true, 'int', 'boolean');
        Assert::assertPositiveInt(true);
    }

    public function testAssertFloat_WhenFloatPassed()
    {
        Assert::assertFloat(0.5);
        Assert::assertFloat(1.0);
        Assert::assertFloat(-0.5);
        Assert::assertFloat(-1.0);
    }

    public function testAssertFloat_WhenIntPassed()
    {
        $this->_setExpectedInvalidArgumentException(1, 'float', 'integer');
        Assert::assertFloat(1);
    }

    public function testAssertFloat_WhenBoolPassed()
    {
        $this->_setExpectedInvalidArgumentException(true, 'float', 'boolean');
        Assert::assertFloat(true);
    }

    public function testAssertFloat_WhenNullPassed()
    {
        $this->_setExpectedInvalidArgumentException(null, 'float', 'NULL');
        Assert::assertFloat(null);
    }

    public function testAssertFloat_WhenStringPassed()
    {
        $this->_setExpectedInvalidArgumentException("1.2", 'float', 'string');
        Assert::assertFloat("1.2");
    }

    public function testAssertIndexInBounds_IndexWithinBounds()
    {
        Assert::assertIndexWithinBounds(1, 0, 2);
    }

    public function testAssertIndexInBounds_EdgeOfLowerBound()
    {
        Assert::assertIndexWithinBounds(0, 0, 2);
    }

    public function testAssertIndexInBounds_EdgeOfUpperBound()
    {
        Assert::assertIndexWithinBounds(2, 0, 2);
    }

    public function testAssertIndexInBounds_BelowLowerBound()
    {
        $this->setExpectedException("Clumsy\Exception\OutOfBoundsException", "Index: -1, Lower Bound: 0, Upper Bound: 2");
        Assert::assertIndexWithinBounds(-1, 0, 2);
    }

    public function testAssertIndexInBounds_AboveUpperBound()
    {
        $this->setExpectedException("Clumsy\Exception\OutOfBoundsException", "Index: 2, Lower Bound: 0, Upper Bound: 1");
        Assert::assertIndexWithinBounds(2, 0, 1);
    }

    public function testAssertIndexInBounds_UpperBoundGreaterThanLowerBound()
    {
        $this->setExpectedException("Clumsy\Exception\UpperGreaterThanLowerException", "Upper: 0, Lower: 1");
        Assert::assertIndexWithinBounds(0, 1, 0);
    }

    public function testAssertIndexInBounds_WhenIntNotPassedForIndex()
    {
        $this->_setExpectedInvalidArgumentException(2.0, 'int', 'double');
        Assert::assertIndexWithinBounds(2.0, 0, 0);
    }

    public function testAssertIndexInBounds_WhenIntNotPassedForLowerBound()
    {
        $this->_setExpectedInvalidArgumentException(false, 'int', 'boolean');
        Assert::assertIndexWithinBounds(0, false, 1);
    }

    public function testAssertIndexInBounds_WhenIntNotPassedForUpperBound()
    {
        $this->_setExpectedInvalidArgumentException("4", 'int', 'string');
        Assert::assertIndexWithinBounds(0, 0, "4");
    }

    public function testAssertIsSet_WhenSet()
    {
        $var = 4;
        Assert::assertIsSet($var);
    }

    public function testAssertIsSet_WhenNotSet()
    {
        $this->setExpectedException("Clumsy\Exception\IsNotSetException");
        Assert::assertIsSet(null);
    }

    public function testAssertIsSet_WhenStringGiven()
    {
        Assert::assertIsSet("string");
    }

    public function testAssertIsSet_WhenEmptyArrayGiven()
    {
        $array = array();
        Assert::assertIsSet($array);
    }

    public function testAssert_CannotBeInstantiated()
    {
        $reflection = new ReflectionClass("Clumsy\Utility\Assert");
        $this->assertFalse($reflection->isInstantiable());
    }

    public function testAssert_CannotBeExtended()
    {
        $reflection = new ReflectionClass("Clumsy\Utility\Assert");
        $this->assertTrue($reflection->isFinal());
    }

    public function testAssertFileExists_WhenFileFound()
    {
        $this->_root->addChild(vfsStream::newFile("myFile.txt"));
        Assert::assertFileExists(vfsStream::url('test/myFile.txt'));
    }

    public function testAssertFileExists_WhenFileNotFound()
    {
        $this->setExpectedException("Clumsy\Exception\FileNotFoundException");
        Assert::assertFileExists(vfsStream::url('test/myFile.txt'));
    }

    public function testAssertFileExists_WhenFileFoundIsNotAFile()
    {
        $this->_setExpectedInvalidArgumentException(vfsStream::url('test'), "file");
        Assert::assertFileExists(vfsStream::url('test'));
    }

    public function testAssertDirExists_WhenDirFound()
    {
        Assert::assertDirExists(vfsStream::url('test'));
    }

    public function testAssertDirExists_WhenDirNotFound()
    {
        $this->setExpectedException("Clumsy\Exception\DirNotFoundException");
        Assert::assertDirExists(vfsStream::url('test/doesNotExist'));
    }

    public function testAssertDirExists_WhenDirFoundIsNotADir()
    {
        $this->_root->addChild(vfsStream::newFile("myFile.txt"));
        $this->_setExpectedInvalidArgumentException(vfsStream::url('test/myFile.txt'), "directory");
        Assert::assertDirExists(vfsStream::url('test/myFile.txt'));
    }

    public function testAssertFileIsReadable_WhenIsReadable()
    {
        $this->_root->addChild(vfsStream::newFile("myFile.txt"));
        Assert::assertFileIsReadable(vfsStream::url('test/myFile.txt'));
    }

    public function testAssertFileIsReadable_WhenNotReadable()
    {
        $this->setExpectedException("Clumsy\Exception\FileNotReadableException");
        $this->_root->addChild(vfsStream::newFile("myFile.txt", 0));
        Assert::assertFileIsReadable(vfsStream::url('test/myFile.txt'));
    }

    public function testAssertFileIsWritable_WhenIsWritable()
    {
        $this->_root->addChild(vfsStream::newFile("myFile.txt"));
        Assert::assertFileIsWritable(vfsStream::url('test/myFile.txt'));
    }

    public function testAssertFileIsWritable_WhenNotWritable()
    {
        $this->setExpectedException("Clumsy\Exception\FileNotWritableException");
        $this->_root->addChild(vfsStream::newFile("myFile.txt", 0));
        Assert::assertFileIsWritable(vfsStream::url('test/myFile.txt'));
    }

    public function testAssertDirIsReadable_WhenIsReadable()
    {
        Assert::assertDirIsReadable(vfsStream::url("test"));
    }

    public function testAssertDirIsReadable_WhenNotReadable()
    {
        $this->setExpectedException("Clumsy\Exception\DirNotReadableException");
        $this->_root->addChild(vfsStream::newDirectory("notReadable", 0));
        Assert::assertDirIsReadable(vfsStream::url("test/notReadable"));
    }

    public function testAssertDirIsWritable_WhenIsWritable()
    {
        Assert::assertDirIsWritable(vfsStream::url("test"));
    }

    public function testAssertDirIsWritable_WhenNotWritable()
    {
        $this->setExpectedException("Clumsy\Exception\DirNotWritableException");
        $this->_root->addChild(vfsStream::newDirectory("notReadable", 0));
        Assert::assertDirIsWritable(vfsStream::url("test/notReadable"));
    }

    public function testAssertNonNegativeInt_WhenIntPassed()
    {
        Assert::assertNonNegativeInt(0);
    }

    public function testAssertNonNegativeInt_WhenNonIntPassed()
    {
        self::_setExpectedInvalidArgumentException(null, "int", "NULL");
        Assert::assertNonNegativeInt(null);
    }

    public function testAssertNonNegativeInt_NegativeIntPassed()
    {
        self::_setExpectedInvalidArgumentException(-5, "non negative int");
        Assert::assertNonNegativeInt(-5);
    }

    public function testAssertObject_WithObject()
    {
        $value = new stdClass();
        Assert::assertObject($value);
    }

    public function testAssertObject_WithoutObject()
    {
        $this->_setExpectedInvalidArgumentException(5, "object", "integer");
        Assert::assertObject(5);
    }

    public function testAssertInstanceOf_WithCorrectClass()
    {
        Assert::assertInstanceOf(new stdClass(), "stdClass");
    }

    public function testAssertInstanceOf_WithIncorrectClass()
    {
        $this->setExpectedException("Clumsy\Exception\InvalidArgumentException",
            "Expected an object of class SomeOtherClass but received object of class stdClass");
        Assert::assertInstanceOf(new stdClass(), "SomeOtherClass");
    }

    public function testAssertArray_WithArray()
    {
        Assert::assertArray(array());
    }

    public function testAssertArray_WithNonArray()
    {
        $this->_setExpectedInvalidArgumentException(null, "array", "NULL");
        Assert::assertArray(null);
    }

    /**
     * @param mixed $value
     * @param string $expectedType
     * @param string $realType
     */
    private function _setExpectedInvalidArgumentException($value, $expectedType, $realType = null)
    {
        $this->setExpectedException(
            "Clumsy\Exception\InvalidArgumentException",
            "The value ($value) is not a $expectedType."
            . ($realType != null ? " The actual type is $realType." : "")
        );
    }
}