<?php

declare(strict_types=1);

namespace Iquety\Domain\Core;

/**
 * Os objetos de valor não possuem indentidade e são diferenciados pelos seus
 * valores. Um objeto de valor composto, contendo dois valores (ex: 'Nome' e 'Sobrenome'),
 * deve ser comparado levando em conta seus dois valores.
 */
abstract class ValueObject
{
    use StateExtraction;

    public function equalTo(ValueObject $other): bool
    {
        return $this instanceof $other
            && $this->toArray() === $other->toArray();
    }

    public function value(): mixed
    {
        $valueList = $this->toArray();

        if (count($valueList) === 1) {
            return current($valueList);
        }

        return $valueList;
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return $this->extractStateValues();
    }

    public function __toString(): string
    {
        return $this->extractStateString();
    }
}
