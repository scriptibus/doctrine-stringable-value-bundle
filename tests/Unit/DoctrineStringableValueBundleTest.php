<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Scriptibus\DoctrineStringableValueBundle\DependencyInjection\Compiler\AddEventListenerTagPass;
use Scriptibus\DoctrineStringableValueBundle\DoctrineStringableValueBundle;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class DoctrineStringableValueBundleTest extends TestCase
{
    public function testAddsCompilerPass(): void
    {
        $bundle = new DoctrineStringableValueBundle();
        $containerMock = self::createMock(ContainerBuilder::class);

        $containerMock->expects(self::once())->method('addCompilerPass')->with(
            self::isInstanceOf(AddEventListenerTagPass::class),
            PassConfig::TYPE_BEFORE_OPTIMIZATION,
            1
        );

        $bundle->build($containerMock);
    }
}
