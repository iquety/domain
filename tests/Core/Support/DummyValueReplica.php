<?php

declare(strict_types=1);

namespace Tests\Core\Support;

use Iquety\Domain\Core\ValueObject;

class DummyValueReplica extends ValueObject
{
    public function __construct(private string $myValue)
    {
    }
}
