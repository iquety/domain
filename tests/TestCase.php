<?php

declare(strict_types=1);

namespace Tests;

use ArrayObject;
use DateTimeImmutable;
use DateTimeZone;
use Iquety\Domain\Core\IdentityObject;
use PHPUnit\Framework\TestCase as FrameworkTestCase;
use ReflectionObject;
use Tests\Core\Support\DummyEntity;
use Tests\Core\Support\DummyValue;
use Tests\Domain\Stream\Support\DummyStreamEntity;

/** @SuppressWarnings(PHPMD.NumberOfChildren) */
class TestCase extends FrameworkTestCase
{
    public function getPropertyValue(object $instance, string $name): mixed
    {
        $reflection = new ReflectionObject($instance);
        $property = $reflection->getProperty($name);
        $property->setAccessible(true);

        return $property->getValue($instance);
    }

    /** @return array<string,mixed> */
    public function stateValues(): array
    {
        return [
            'aggregateId' => new IdentityObject('123456'),
            'one' => 'Ricardo',
            'two' => 30,
            'three' => 5.5,
            'four' => new DateTimeImmutable(),
            'five' => new ArrayObject(),
            'six' => new DummyValue('test1'),
            'seven' => new DummyEntity(new IdentityObject('111'), 'test2'),
        ];
    }

    /** @SuppressWarnings(PHPMD.StaticAccess) */
    public function dummyStreamEntityFactory(
        string $expression = "now",
        string $timezone = "UTC"
    ): DummyStreamEntity {

        $values = $this->stateValues();
        $values['occurredOn'] = new DateTimeImmutable($expression, new DateTimeZone($timezone));

        /** @var DummyStreamEntity */
        return DummyStreamEntity::factory($values);
    }
}
