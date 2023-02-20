<?php

declare(strict_types=1);

namespace Tests\Core\Support;

use Iquety\Domain\Core\Entity;
use Iquety\Domain\Core\IdentityObject;

class DummyEntityReplica extends Entity
{
    public function __construct(
        private IdentityObject $identity,
        private string $myValue
    ) {
    }

    public function identity(): IdentityObject
    {
        return $this->identity;
    }
}
