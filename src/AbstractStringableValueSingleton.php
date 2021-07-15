<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle;

abstract class AbstractStringableValueSingleton implements StringableValueInterface
{
    /**
     * @var array<string, static>
     */
    protected static $instances = [];

    private function __construct()
    {
    }

    /**
     * {@inheritdoc}
     */
    public static function create(): StringableValueInterface
    {
        if (!isset(self::$instances[get_called_class()])){
            self::$instances[get_called_class()] = new static();
        }

        return self::$instances[get_called_class()];
    }
}
