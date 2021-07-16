<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Unit\Doctrine\Type;

use PHPUnit\Framework\TestCase;
use Scriptibus\DoctrineStringableValueBundle\Doctrine\Type\StringableValueType;
use Scriptibus\DoctrineStringableValueBundle\Tests\Resource\FakePlatform;
use Scriptibus\DoctrineStringableValueBundle\Tests\Resource\SomeStringableValue;

final class StringableValueTypeTest extends TestCase
{
    public function testGetNameReturnsName(): void
    {
        $type = new StringableValueType();

        self::assertSame(StringableValueType::STRINGABLE_VALUE, $type->getName());
    }

    public function testConvertToDatabaseValueRequiresStringableValueInstance(): void
    {
        self::expectException(\InvalidArgumentException::class);

        $type = new StringableValueType();
        $type->convertToDatabaseValue('some-invalid-value', new FakePlatform());
    }

    public function testConvertToDatabaseValueReturnsStrungValue(): void
    {
        $type = new StringableValueType();
        $result = $type->convertToDatabaseValue(SomeStringableValue::create(), new FakePlatform());

        self::assertSame(SomeStringableValue::VALUE, $result);
    }

    public function testConvertToPHPValueReturnsNullWhenNullIsProvided(): void
    {
        $type = new StringableValueType();
        $result = $type->convertToPHPValue(null, new FakePlatform());

        self::assertNull($result);
    }

    public function testConvertToPHPValueReturnsCorrectObject(): void
    {
        $type = new StringableValueType();
        $result = $type->convertToPHPValue(SomeStringableValue::VALUE, new FakePlatform());

        self::assertInstanceOf(SomeStringableValue::class, $result);
    }
}
