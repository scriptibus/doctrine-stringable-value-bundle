<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Doctrine\EventListener;

use Scriptibus\DoctrineStringableValueBundle\Service\StringableValueResolverInterface;

final class GetStringableValueResolverListener implements GetStringableValueResolverListenerInterface
{
    /**
     * @var StringableValueResolverInterface
     */
    private $stringableValueResolver;

    public function __construct(StringableValueResolverInterface $stringableValueResolver)
    {
        $this->stringableValueResolver = $stringableValueResolver;
    }

    public function getStringableValueResolver(): StringableValueResolverInterface
    {
        return $this->stringableValueResolver;
    }
}
