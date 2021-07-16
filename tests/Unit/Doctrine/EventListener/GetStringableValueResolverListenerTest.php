<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Unit\Doctrine\EventListener;

use PHPUnit\Framework\TestCase;
use Scriptibus\DoctrineStringableValueBundle\Doctrine\EventListener\GetStringableValueResolverListener;
use Scriptibus\DoctrineStringableValueBundle\Service\StringableValueResolverInterface;

final class GetStringableValueResolverListenerTest extends TestCase
{
    public function testReturnsInsertedService(): void
    {
        $resolverMock = self::createMock(StringableValueResolverInterface::class);
        $listener = new GetStringableValueResolverListener($resolverMock);

        self::assertSame($resolverMock, $listener->getStringableValueResolver());
    }
}
