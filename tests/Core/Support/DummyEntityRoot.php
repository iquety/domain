<?php

declare(strict_types=1);

namespace Tests\Core\Support;

use Iquety\Domain\Core\Entity;
use Iquety\Domain\Core\IdentityObject;

class DummyEntityRoot extends Entity
{
    public function __construct(
        private IdentityObject $identity,
        private string $simple,
        private DummyEntity $entity,
        private DummyValue $value
    ) {
    }

    public function identity(): IdentityObject
    {
        return $this->identity;
    }

    // public function simple(): string
    // {
    //     return $this->simple;
    // }

    // public function entity(): DummyEntity
    // {
    //     return $this->entity;
    // }

    // public function value(): DummyValue
    // {
    //     return $this->value;
    // }
}
