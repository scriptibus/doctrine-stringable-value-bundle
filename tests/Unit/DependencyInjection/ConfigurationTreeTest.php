<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Unit\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Scriptibus\DoctrineStringableValueBundle\DependencyInjection\ConfigurationTree;

final class ConfigurationTreeTest extends TestCase
{
    public function testTreeCanBeCreated(): void
    {
        $treeBuilder = new ConfigurationTree();
        $treeBuilder->getConfigTreeBuilder();

        self::addToAssertionCount(1);
    }
}
