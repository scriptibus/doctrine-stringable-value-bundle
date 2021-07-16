<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Scriptibus\DoctrineStringableValueBundle\Tests\Resource\AnotherAbstractStringableValueSingletonChild;
use Scriptibus\DoctrineStringableValueBundle\Tests\Resource\SomeAbstractStringableValueSingletonChild;

final class AbstractStringableValueSingletonTest extends TestCase
{
    public function testReturnsSingletonInstance(): void
    {
        $singleton = SomeAbstractStringableValueSingletonChild::create();
        $second = SomeAbstractStringableValueSingletonChild::create();

        self::assertSame($singleton, $second);
    }

    public function testReturnsDifferentSingletonsForDifferentChildren(): void
    {
        $singleton = SomeAbstractStringableValueSingletonChild::create();
        $second = AnotherAbstractStringableValueSingletonChild::create();

        self::assertInstanceOf(SomeAbstractStringableValueSingletonChild::class, $singleton);
        self::assertInstanceOf(AnotherAbstractStringableValueSingletonChild::class, $second);
        self::assertNotSame($singleton, $second);
    }
}
