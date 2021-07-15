<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle;

abstract class AbstractStringableValueSingleton implements StringableValueInterface
{
    /**
     * @var array<string, static>
     */
    protected static $instances = [];

    final private function __construct()
    {
    }

    /**
     * {@inheritdoc}
     */
    public static function create(): StringableValueInterface
    {
        if (!isset(self::$instances[static::class])) {
            self::$instances[static::class] = new static();
        }

        return self::$instances[static::class];
    }
}
