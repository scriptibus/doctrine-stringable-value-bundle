<?php

declare(strict_types=1);

namespace Scriptibus\DoctrineStringableValueBundle\Service;

use RuntimeException;
use Scriptibus\DoctrineStringableValueBundle\AbstractStringableValue;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

final class StringableValueResolver implements StringableValueResolverInterface
{
    /**
     * @var array<AbstractStringableValue>
     */
    private $stringableValueMap;


    /**
     * @param array<string> $classes
     */
    public function __construct(array $classes)
    {
        $this->initStringableValueMap($classes);
    }

    public function getObjectForValue(string $value): AbstractStringableValue
    {
        if (isset($this->stringableValueMap[$value])) {
            return $this->stringableValueMap[$value];
        }

        throw new RuntimeException(
            sprintf(
                'Could not resolve value "%s" to object. Possible values are: "%s"',
                $value,
                implode(array_keys($this->stringableValueMap))
            )
        );
    }

    private function initStringableValueMap(array $classNames): void
    {
        foreach ($classNames as $className) {
            if (!class_exists($className)) {
                throw new InvalidConfigurationException(sprintf('Class "%s" could not be found.', $className));
            }
            if (!is_subclass_of($className, AbstractStringableValue::class)) {
                throw new InvalidConfigurationException(
                    sprintf('Class "%s" must implement "%s"', $className, AbstractStringableValue::class)
                );
            }

            /** @var AbstractStringableValue $instance */
            $instance = call_user_func([$className, 'getInstance']);

            if (isset($this->stringableValueMap[$instance->__toString()])) {
                throw new InvalidConfigurationException(
                    sprintf(
                        'Classes "%s" and "%s" must not share the same string value "%s"',
                        $className,
                        get_class($this->stringableValueMap[$instance->__toString()]),
                        $instance->__toString()
                    )
                );
            }

            $this->stringableValueMap[$instance->__toString()] = $instance;
        }
    }
}
