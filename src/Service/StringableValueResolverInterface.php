<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Service;

use Scriptibus\DoctrineStringableValueBundle\AbstractStringableValue;

interface StringableValueResolverInterface
{
    public function getObjectForValue(string $value): AbstractStringableValue;
}
