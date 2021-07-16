<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\DependencyInjection\Compiler;

use Scriptibus\DoctrineStringableValueBundle\Doctrine\EventListener\GetStringableValueResolverListenerInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class AddEventListenerTagPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $definition = $container->getDefinition(GetStringableValueResolverListenerInterface::class);
        $definition->addTag('doctrine.event_listener', ['event' => 'getStringableValueResolver']);
    }
}
