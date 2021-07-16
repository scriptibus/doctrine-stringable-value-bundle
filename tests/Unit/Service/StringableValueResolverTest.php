<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use Scriptibus\DoctrineStringableValueBundle\Service\StringableValueResolver;
use Scriptibus\DoctrineStringableValueBundle\Tests\Resource\SomeRandomClass;
use Scriptibus\DoctrineStringableValueBundle\Tests\Resource\SomeStringableValue;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

final class StringableValueResolverTest extends TestCase
{
    public function testCanBeCreatedWithEmptyArray(): void
    {
        new StringableValueResolver([]);

        self::addToAssertionCount(1);
    }

    public function testNonExistingFQCNThrowsException(): void
    {
        self::expectException(InvalidConfigurationException::class);
        self::expectExceptionMessageMatches('/could not be found/');

        new StringableValueResolver(['non-existing-fqcn']);
    }

    public function testClassNotImplementingStringableValueThrowsException(): void
    {
        self::expectException(InvalidConfigurationException::class);
        self::expectExceptionMessageMatches('/must implement/');

        new StringableValueResolver([SomeRandomClass::class]);
    }

    public function testClassWithDuplicateStringValueThrowsException(): void
    {
        self::expectException(InvalidConfigurationException::class);
        self::expectExceptionMessageMatches('/share the same string value/');

        new StringableValueResolver([SomeStringableValue::class, SomeStringableValue::class]);
    }

    public function testGetObjectForValueWithInvalidValueThrowsException(): void
    {
        self::expectException(\RuntimeException::class);
        self::expectExceptionMessageMatches('/Could not resolve value/');

        $resolver = new StringableValueResolver([SomeStringableValue::class]);
        $resolver->getObjectForValue('some-invalid-value');
    }

    public function testGetObjectForValueReturnsCorrectObject(): void
    {
        $resolver = new StringableValueResolver([SomeStringableValue::class]);
        $result = $resolver->getObjectForValue(SomeStringableValue::VALUE);

        self::assertInstanceOf(SomeStringableValue::class, $result);
    }
}
