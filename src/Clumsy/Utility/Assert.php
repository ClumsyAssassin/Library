<?php

namespace Clumsy\Utility;

use Clumsy\Exception\DirNotFoundException;
use Clumsy\Exception\DirNotReadableException;
use Clumsy\Exception\DirNotWritableException;
use Clumsy\Exception\FileNotFoundException;
use Clumsy\Exception\FileNotReadableException;
use Clumsy\Exception\FileNotWritableException;
use Clumsy\Exception\InvalidArgumentException;
use Clumsy\Exception\IsNotSetException;
use Clumsy\Exception\OutOfBoundsException;
use Clumsy\Exception\UpperGreaterThanLowerException;

/**
 * Class Assert
 *
 * This is a utility class for primarily checking the argument types for php functions when type hinting is not
 * available and for asserting arguments are not empty if arrays are passed.
 *
 * @package Clumsy\Utility
 */
final class Assert
{
    /**
     * Prevent the constructor from being called
     */
    private function __construct()
    {
    }

    /**
     * @param string $value
     */
    public static function assertString($value)
    {
        if (!is_string($value))
            self::_throwInvalidArgumentException($value, 'string');

    }

    /**
     * @param bool $value
     */
    public static function assertBool($value)
    {
        if (!is_bool($value))
            self::_throwInvalidArgumentException($value, 'bool');
    }

    /**
     * @param int $value
     */
    public static function assertInt($value)
    {
        if (!is_int($value))
            self::_throwInvalidArgumentException($value, 'int');
    }

    /**
     * @param float|int $value
     */
    public static function assertPositiveNumber($value)
    {
        self::assertNumber($value);
        if ($value <= 0)
            self::_throwInvalidArgumentException($value, "positive number", false);
    }

    /**
     * @param int|float $value
     */
    public static function assertNumber($value)
    {
        if (!is_float($value) && !is_int($value))
            self::_throwInvalidArgumentException($value, 'number');
    }

    /**
     * @param float $value
     */
    public static function assertFloat($value)
    {
        if (!is_float($value))
            self::_throwInvalidArgumentException($value, "float");
    }

    /**
     * @param int $value
     */
    public static function assertPositiveInt($value)
    {
        self::assertInt($value);
        self::assertPositiveNumber($value);
    }

    /**
     * @param int $value
     */
    public static function assertNonNegativeInt($value)
    {
        self::assertInt($value);
        if ($value < 0)
            self::_throwInvalidArgumentException($value, "non negative int", "actual");
    }

    /**
     * @param int $index
     * @param int $lowerBound
     * @param int $upperBound
     * @throws UpperGreaterThanLowerException
     * @throws OutOfBoundsException
     */
    public static function assertIndexWithinBounds($index, $lowerBound, $upperBound)
    {
        self::assertInt($index);
        self::assertInt($lowerBound);
        self::assertInt($upperBound);

        if ($upperBound < $lowerBound) {
            throw new UpperGreaterThanLowerException("Upper: {$upperBound}, Lower: {$lowerBound}");
        }

        if ($index < $lowerBound || $index > $upperBound) {
            throw new OutOfBoundsException("Index: {$index}, Lower Bound: {$lowerBound}, Upper Bound: {$upperBound}");
        }
    }

    /**
     * @param mixed $value
     * @throws IsNotSetException
     */
    public static function assertIsSet($value)
    {
        if (!isset($value)) {
            throw new IsNotSetException();
        }
    }

    /**
     * @param string $filename
     * @throws \Clumsy\Exception\FileNotFoundException
     */
    public static function assertFileExists($filename)
    {
        if (file_exists($filename)) {
            if (!is_file($filename))
                self::_throwInvalidArgumentException($filename, "file", false);
        } else
            throw new FileNotFoundException();
    }

    /**
     * @param string $dir
     * @throws \Clumsy\Exception\DirNotFoundException
     */
    public static function assertDirExists($dir)
    {
        if (file_exists($dir)) {
            if (!is_dir($dir))
                self::_throwInvalidArgumentException($dir, "directory", false);
        } else
            throw new DirNotFoundException();
    }

    /**
     * @param string $file
     * @throws \Clumsy\Exception\FileNotReadableException
     */
    public static function assertFileIsReadable($file)
    {
        self::assertFileExists($file);
        if (!is_readable($file))
            throw new FileNotReadableException("File: $file");
    }

    /**
     * @param string $dir
     * @throws \Clumsy\Exception\DirNotReadableException
     */
    public static function assertDirIsReadable($dir)
    {
        self::assertDirExists($dir);
        if (!is_readable($dir))
            throw new DirNotReadableException("Dir: $dir");
    }

    /**
     * @param string $file
     * @throws \Clumsy\Exception\FileNotWritableException
     */
    public static function assertFileIsWritable($file)
    {
        self::assertFileExists($file);
        if (!is_writable($file))
            throw new FileNotWritableException("File: $file");
    }

    /**
     * @param string $dir
     * @throws \Clumsy\Exception\DirNotWritableException
     */
    public static function assertDirIsWritable($dir)
    {
        self::assertDirExists($dir);
        if (!is_writable($dir))
            throw new DirNotWritableException("Dir: $dir");
    }

    /**
     * @param mixed $value
     */
    public static function assertObject($value)
    {
        if (!is_object($value))
            self::_throwInvalidArgumentException($value, "object");
    }

    /**
     * @param mixed $object
     * @param string $class
     * @throws \Clumsy\Exception\InvalidArgumentException
     */
    public static function assertInstanceOf($object, $class)
    {
        self::assertObject($object);
        self::assertString($class);

        $className = get_class($object);

        if (!$object instanceof $class)
            throw new InvalidArgumentException("Expected an object of class {$class} but received object of class {$className}");
    }

    /**
     * @param array $array
     */
    public static function assertArray($array)
    {
        if (!is_array($array))
            self::_throwInvalidArgumentException($array, "array");
    }

    /**
     * Throw an invalid argument exception with a standard message
     * @param mixed $passedValue
     * @param string $expectedType
     * @param bool $actualTypeMessage
     * @throws InvalidArgumentException
     */
    private static function _throwInvalidArgumentException($passedValue, $expectedType, $actualTypeMessage = true)
    {
        throw new InvalidArgumentException("The value ({$passedValue}) is not a {$expectedType}."
            . ($actualTypeMessage ? " The actual type is " . gettype($passedValue) . "." : ""));
    }
} 