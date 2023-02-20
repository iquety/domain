<?php

declare(strict_types=1);

namespace Tests\Core\Support;

use Iquety\Domain\Core\ValueObject;

class DummyCompositeValue extends ValueObject
{
    public function __construct(private string $myValue, private string $other)
    {
    }
}
