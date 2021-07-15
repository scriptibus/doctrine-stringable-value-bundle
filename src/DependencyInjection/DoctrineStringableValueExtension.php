<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class DoctrineStringableValueExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configurationTree = new ConfigurationTree();
        $config = $this->processConfiguration($configurationTree, $configs);

        $container->setParameter('stringable_value.classes', $config['classes'] ?? []);

        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $loader->load('services.xml');
    }
}
