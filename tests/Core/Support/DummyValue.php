<?php

declare(strict_types=1);

namespace Tests\Core\Support;

use Iquety\Domain\Core\ValueObject;

class DummyValue extends ValueObject
{
    public function __construct(private string $myValue)
    {
    }
}
