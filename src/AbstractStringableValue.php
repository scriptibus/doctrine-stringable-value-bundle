<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle;

abstract class AbstractStringableValue implements \Stringable
{
    /** @var ?static */
    private static $instance = null;

    private function __construct()
    {
    }

    public static function create(): self
    {
        if (self::$instance !== null){
            self::$instance = new static();
        }

        return self::$instance;
    }
}
