<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/12/19
 * Time: 10:45 PM
 */

namespace Elyurt\Common;


interface DomainEvent
{
    public function occurredOn() : \DateTimeImmutable;
}