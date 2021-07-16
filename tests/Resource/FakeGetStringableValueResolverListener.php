<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Resource;

use Scriptibus\DoctrineStringableValueBundle\Doctrine\EventListener\GetStringableValueResolverListenerInterface;
use Scriptibus\DoctrineStringableValueBundle\Service\StringableValueResolver;
use Scriptibus\DoctrineStringableValueBundle\Service\StringableValueResolverInterface;

final class FakeGetStringableValueResolverListener implements GetStringableValueResolverListenerInterface
{
    public function getStringableValueResolver(): StringableValueResolverInterface
    {
        return new StringableValueResolver([SomeStringableValue::class]);
    }
}
