<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Service;

use RuntimeException;
use Scriptibus\DoctrineStringableValueBundle\StringableValueInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

final class StringableValueResolver implements StringableValueResolverInterface
{
    /**
     * @var array<StringableValueInterface>
     */
    private $stringableValueMap;

    /**
     * @param array<string> $classes
     */
    public function __construct(array $classes)
    {
        $this->initStringableValueMap($classes);
    }

    public function getObjectForValue(string $value): StringableValueInterface
    {
        if (isset($this->stringableValueMap[$value])) {
            return $this->stringableValueMap[$value];
        }

        throw new RuntimeException(sprintf('Could not resolve value "%s" to object. Possible values are: "%s"', $value, implode('', array_keys($this->stringableValueMap))));
    }

    /**
     * @param array<int, string> $classNames
     */
    private function initStringableValueMap(array $classNames): void
    {
        foreach ($classNames as $className) {
            if (!class_exists($className)) {
                throw new InvalidConfigurationException(sprintf('Class "%s" could not be found.', $className));
            }
            if (!is_subclass_of($className, StringableValueInterface::class)) {
                throw new InvalidConfigurationException(sprintf('Class "%s" must implement "%s"', $className, StringableValueInterface::class));
            }

            /** @var StringableValueInterface $instance */
            $instance = \call_user_func([$className, 'create']);

            if (isset($this->stringableValueMap[$instance->__toString()])) {
                throw new InvalidConfigurationException(sprintf('Classes "%s" and "%s" must not share the same string value "%s"', $className, \get_class($this->stringableValueMap[$instance->__toString()]), $instance->__toString()));
            }

            $this->stringableValueMap[$instance->__toString()] = $instance;
        }
    }
}
