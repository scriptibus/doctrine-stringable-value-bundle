<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Resource;

use Scriptibus\DoctrineStringableValueBundle\AbstractStringableValueSingleton;

final class SomeAbstractStringableValueSingletonChild extends AbstractStringableValueSingleton
{
    public function __toString()
    {
        return 'some-string';
    }
}
