<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class ConfigurationTree implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('stringable_value');

        $treeBuilder->getRootNode()
            ->children()

            ->arrayNode('classes')
            ->ignoreExtraKeys(false)
            ->end();

        return $treeBuilder;
    }
}
