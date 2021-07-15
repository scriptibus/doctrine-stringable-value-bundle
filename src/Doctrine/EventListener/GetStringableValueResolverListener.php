<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Doctrine\EventListener;

use Scriptibus\DoctrineStringableValueBundle\Service\StringableValueResolver;

final class GetStringableValueResolverListener
{
    /**
     * @var StringableValueResolver
     */
    private $stringableValueResolver;

    public function __construct(StringableValueResolver $stringableValueResolver)
    {
        $this->stringableValueResolver = $stringableValueResolver;
    }

    public function getStringableValueResolver(): StringableValueResolver
    {
        return $this->stringableValueResolver;
    }
}
