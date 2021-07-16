<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Unit\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Scriptibus\DoctrineStringableValueBundle\DependencyInjection\DoctrineStringableValueExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class DoctrineStringableValueExtensionTest extends TestCase
{
    public function testContainerContainsParameter(): void
    {
        $containerBuilder = new ContainerBuilder();

        $extension = new DoctrineStringableValueExtension();
        $extension->load(
            [
                [
                    'classes' => [
                        'some_fqcn',
                        'another_fqcn',
                    ],
                ],
            ],
            $containerBuilder
        );

        $parameter = $containerBuilder->getParameter('stringable_value.classes');

        self::assertSame(
            [
                'some_fqcn',
                'another_fqcn',
            ],
            $parameter
        );
    }

    public function testEmptyConfigResultsInEmptyArrayParameter(): void
    {
        $containerBuilder = new ContainerBuilder();

        $extension = new DoctrineStringableValueExtension();
        $extension->load([], $containerBuilder);

        $parameter = $containerBuilder->getParameter('stringable_value.classes');

        self::assertIsArray($parameter);
        self::assertEmpty($parameter);
    }
}
