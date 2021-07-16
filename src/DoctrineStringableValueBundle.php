<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle;

use Scriptibus\DoctrineStringableValueBundle\DependencyInjection\Compiler\AddEventListenerTagPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class DoctrineStringableValueBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        //Increase priority by one over default to ensure pass runs before doctrines compiler pass
        $container->addCompilerPass(new AddEventListenerTagPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1);
    }
}
