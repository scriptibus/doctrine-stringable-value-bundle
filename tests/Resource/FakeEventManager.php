<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Resource;

use Doctrine\Common\EventManager;

final class FakeEventManager extends EventManager
{
    public function getListeners($event = null)
    {
        if ('getStringableValueResolver' === $event) {
            return [new FakeGetStringableValueResolverListener()];
        }

        throw new \LogicException('Wrong event provided.');
    }
}
