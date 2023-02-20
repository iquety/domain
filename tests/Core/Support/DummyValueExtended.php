<?php

declare(strict_types=1);

namespace Tests\Core\Support;

class DummyValueExtended extends DummyValue
{
    public function __construct(private string $myValue)
    {
    }
}
