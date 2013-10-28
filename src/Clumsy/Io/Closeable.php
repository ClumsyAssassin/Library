<?php
/**
 * Class Description
 * @author robert
 */

namespace Clumsy\Io;

/**
 * Interface Closeable
 * @package Clumsy\Io
 */
interface Closeable
{
    /**
     * Closes this stream and releases any resources associated with it.
     */
    public function close();
} 