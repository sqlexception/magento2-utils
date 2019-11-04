<?php
declare(strict_types = 1);

namespace SqlException\Utils\Test\Integration\Traits;

/**
 * Trait ObjectManagerTrait
 *
 * @package SqlException\Utils\Test\Integration\Traits
 */
trait ReflectionTrait
{
    /**
     * @param object $object
     * @param string $methodName
     * @param array $parameters
     *
     * @return mixed
     * @throws \ReflectionException
     */
    private function invokeMethod($object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * @param object $object
     * @param string $propertyName
     * @param mixed $value
     * @param string $origClassName
     *
     * @return object
     * @throws \ReflectionException
     */
    private function setProperty($object, $propertyName, $value, $origClassName = '')
    {
        $reflection = new \ReflectionClass($origClassName ?: get_class($object));
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($object, $value);

        return $object;
    }

    /**
     * @param object $object
     * @param string $propertyName
     * @param string $origClassName
     *
     * @return object
     * @throws \ReflectionException
     */
    private function getProperty($object, $propertyName, $origClassName = '')
    {
        $reflection = new \ReflectionClass($origClassName ?: get_class($object));
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);

        return $property->getValue($object);
    }
}