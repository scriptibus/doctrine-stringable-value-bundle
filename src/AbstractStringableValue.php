<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle;

abstract class AbstractStringableValue implements \Stringable
{
    /**
     * @var array<string, static>
     */
    protected static $instances = [];

    private function __construct()
    {
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (!isset(self::$instances[get_called_class()])){
            self::$instances[get_called_class()] = new static();
        }

        return self::$instances[get_called_class()];
    }
}
