<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Unit\DependencyInjection\Compiler;

use PHPUnit\Framework\TestCase;
use Scriptibus\DoctrineStringableValueBundle\DependencyInjection\Compiler\AddEventListenerTagPass;
use Scriptibus\DoctrineStringableValueBundle\Doctrine\EventListener\GetStringableValueResolverListenerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

final class AddEventListenerTagPassTest extends TestCase
{
    public function testPassAddsTagToDefinition(): void
    {
        $pass = new AddEventListenerTagPass();
        $builderMock = self::createMock(ContainerBuilder::class);
        $alias = 'some-alias';
        $definitionMock = self::createMock(Definition::class);

        $builderMock->expects(self::once())->method('getAlias')->with(
            GetStringableValueResolverListenerInterface::class
        )->willReturn($alias);

        $builderMock->expects(self::once())->method('getDefinition')->with($alias)->willReturn($definitionMock);

        $definitionMock->expects(self::once())->method('addTag')->with(
            'doctrine.event_listener',
            ['event' => 'getStringableValueResolver']
        );

        $pass->process($builderMock);
    }
}
