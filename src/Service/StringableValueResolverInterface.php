<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Service;

use Scriptibus\DoctrineStringableValueBundle\StringableValueInterface;

interface StringableValueResolverInterface
{
    public function getObjectForValue(string $value): StringableValueInterface;
}
