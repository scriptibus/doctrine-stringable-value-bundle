<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Doctrine\Type;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;
use InvalidArgumentException;
use Scriptibus\DoctrineStringableValueBundle\Doctrine\EventListener\GetStringableValueResolverListener;
use Scriptibus\DoctrineStringableValueBundle\StringableValueInterface;

final class StringableValueType extends TextType
{
    public const STRINGABLE_VALUE = 'stringable_value';

    public function getName(): string
    {
        return self::STRINGABLE_VALUE;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof StringableValueInterface) {
            throw new InvalidArgumentException(sprintf('Value must be instance of "%s"', StringableValueInterface::class));
        }

        return parent::convertToDatabaseValue($value->__toString(), $platform);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?StringableValueInterface
    {
        $value = parent::convertToPHPValue($value, $platform);

        if (null === $value) {
            return null;
        }

        /** @var EventManager $eventManager */
        $eventManager = $platform->getEventManager();
        $listeners = $eventManager->getListeners('getStringableValueResolver');
        /** @var GetStringableValueResolverListener $listener */
        $listener = array_shift($listeners);
        $resolver = $listener->getStringableValueResolver();

        return $resolver->getObjectForValue($value);
    }
}
