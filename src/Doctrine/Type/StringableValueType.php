<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;
use InvalidArgumentException;
use Scriptibus\DoctrineStringableValueBundle\Doctrine\EventListener\GetStringableValueResolverListener;
use Scriptibus\DoctrineStringableValueBundle\AbstractStringableValue;

class StringableValueType extends TextType
{
    public const STRINGABLE_VALUE = 'stringable_value';

    public function getName(): string
    {
        return self::STRINGABLE_VALUE;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof AbstractStringableValue) {
            throw new InvalidArgumentException('Value must be instance of StringableValue');
        }

        return parent::convertToDatabaseValue($value->__toString(), $platform);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?AbstractStringableValue
    {
        $value = parent::convertToPHPValue($value, $platform);

        if ($value === null) {
            return null;
        }

        $listeners = $platform->getEventManager()->getListeners('getStringableValueResolver');
        /** @var GetStringableValueResolverListener $listener */
        $listener = array_shift($listeners);
        $resolver = $listener->getStringableValueResolver();

        return $resolver->getObjectForValue($value);
    }


}
