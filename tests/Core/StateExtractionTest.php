<?php

declare(strict_types=1);

namespace Tests\Core;

use DateTime;
use DateTimeImmutable;
use Exception;
use Iquety\Domain\Core\IdentityObject;
use Tests\Core\Support\NoConstructor;
use Tests\Core\Support\StateOk;
use Tests\Core\Support\DummyEntity;
use Tests\Core\Support\DummyEntityRoot;
use Tests\Core\Support\DummyValue;
use Tests\TestCase;

class StateExtractionTest extends TestCase
{
    public function methodsProvider(): array
    {
        return [
            'State to array' => ['extractArray'],
            'State to string' => ['extractString'],
        ];
    }

    /**
     * @test
     * @dataProvider methodsProvider
     */
    public function noConstructor(string $method): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage(
            'Every object containing state must have a constructor ' .
            'that takes its complete state'
        );

        $object = new NoConstructor();

        $object->$method();
    }

    /** @test */
    public function arrayRepresentation(): void
    {
        $dateOne = new DateTimeImmutable();
        $dateTwo = new DateTime();

        $object = new StateOk(
            'Ricardo',
            30,
            5.5,
            $dateOne,
            $dateTwo,
            new DummyValue('test1'),
            new DummyEntity(new IdentityObject('111'), 'test2'),
            new DummyEntityRoot(
                new IdentityObject('222'),
                'test3',
                new DummyEntity(new IdentityObject('333'), 'test4'),
                new DummyValue('test5'),
            ),
        );

        $this->assertEquals([
            'one' => 'Ricardo',
            'two' => 30,
            'three' => 5.5,
            'four' => $dateOne,
            'five' => $dateTwo,
            'six' => new DummyValue('test1'),
            'seven' => new DummyEntity(new IdentityObject('111'), 'test2'),
            'eight' => new DummyEntityRoot(
                new IdentityObject('222'),
                'test3',
                new DummyEntity(new IdentityObject('333'), 'test4'),
                new DummyValue('test5'),
            ),
        ], $object->extractArray());
    }

    /** @test */
    public function stringRepresentation(): void
    {
        $dateOne = new DateTimeImmutable();
        $dateTwo = new DateTime();

        $object = new StateOk(
            'Ricardo',
            30,
            5.5,
            $dateOne,
            $dateTwo,
            new DummyValue('test1'),
            new DummyEntity(new IdentityObject('111'), 'test2'),
            new DummyEntityRoot(
                new IdentityObject('222'),
                'test3',
                new DummyEntity(new IdentityObject('333'), 'test4'),
                new DummyValue('test5'),
            ),
        );

        $this->assertEquals("StateOk [\n" .
            "    one = Ricardo\n" .
            "    two = 30\n" .
            "    three = 5.5\n" .
            "    four = DateTimeImmutable UTC [" . $dateOne->format("Y-m-d H:i:s.u") . "]\n" .
            "    five = DateTime UTC [" . $dateTwo->format("Y-m-d H:i:s.u") . "]\n" .
            "    six = DummyValue [test1]\n" .
            "    seven = DummyEntity [...]\n" .
            "    eight = DummyEntityRoot [...]\n" .
        "]", $object->extractString());
    }
}
