<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Resource;

use Scriptibus\DoctrineStringableValueBundle\StringableValueInterface;

final class SomeStringableValue implements StringableValueInterface
{
    public const VALUE = 'some-value';

    public function __toString()
    {
        return self::VALUE;
    }

    public static function create(): StringableValueInterface
    {
        return new self();
    }
}
