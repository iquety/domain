<?php

declare(strict_types=1);

namespace Iquety\Domain\Event;

use Iquety\Domain\Core\IdentityObject;
use Iquety\Domain\Core\ValueParser;
use Iquety\PubSub\Event\Event;

/**
 * Eventos de dominio devem possuir apenas objetos de valor (ObjetoValor,
 * ObjetoIdentidade, DateTimeImmutable) ou tipos primitivos simples ('string',
 * 'int', 'float', 'bool' e 'array'), para que sejam serializados e persistidos
 * em banco de dados.
 */
abstract class DomainEvent extends Event
{
    abstract public function aggregateId(): IdentityObject;

    abstract public static function aggregateLabel(): string;

    abstract public static function label(): string;

    /** @return array<string,mixed> */
    public function toPrimitives(): array
    {
        return (new ValueParser($this->toArray()))->toPrimitives();
    }
}
