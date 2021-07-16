<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Tests\Resource;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class FakePlatform extends AbstractPlatform
{
    public function getEventManager(): ?EventManager
    {
        /** @var EventManager $eventManager */
        $eventManager = new FakeEventManager();

        return $eventManager;
    }

    public function getBooleanTypeDeclarationSQL(array $column)
    {
        throw $this->notImplemented(__METHOD__);
    }

    public function getIntegerTypeDeclarationSQL(array $column)
    {
        throw $this->notImplemented(__METHOD__);
    }

    public function getBigIntTypeDeclarationSQL(array $column)
    {
        throw $this->notImplemented(__METHOD__);
    }

    public function getSmallIntTypeDeclarationSQL(array $column)
    {
        throw $this->notImplemented(__METHOD__);
    }

    protected function _getCommonIntegerTypeDeclarationSQL(array $column)
    {
        throw $this->notImplemented(__METHOD__);
    }

    protected function initializeDoctrineTypeMappings()
    {
        throw $this->notImplemented(__METHOD__);
    }

    public function getClobTypeDeclarationSQL(array $column)
    {
        throw $this->notImplemented(__METHOD__);
    }

    public function getBlobTypeDeclarationSQL(array $column)
    {
        throw $this->notImplemented(__METHOD__);
    }

    public function getName()
    {
        throw $this->notImplemented(__METHOD__);
    }

    public function getCurrentDatabaseExpression(): string
    {
        throw $this->notImplemented(__METHOD__);
    }

    private function notImplemented(string $method): \LogicException
    {
        return new \LogicException(sprintf('Method "%s" is not implemented.', $method));
    }
}
