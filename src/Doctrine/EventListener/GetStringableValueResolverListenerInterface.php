<?php

namespace Scriptibus\DoctrineStringableValueBundle\Doctrine\EventListener;

use Scriptibus\DoctrineStringableValueBundle\Service\StringableValueResolverInterface;

interface GetStringableValueResolverListenerInterface
{
    public function getStringableValueResolver(): StringableValueResolverInterface;
}
