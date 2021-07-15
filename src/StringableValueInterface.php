<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle;

use Stringable;

interface StringableValueInterface extends Stringable
{
    /**
     * @return static
     */
    public static function create(): self;
}
