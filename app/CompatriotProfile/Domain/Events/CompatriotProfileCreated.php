<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/13/19
 * Time: 3:06 PM
 */

namespace Elyurt\CompatriotProfile\Domain\Events;

use Elyurt\Common\DomainEvent;
use Elyurt\CompatriotProfile\Domain\CompatriotProfileId;

class CompatriotProfileCreated implements DomainEvent
{
    /**
     * @var CompatriotProfileId
     */
    private $id;
    /**
     * @var \DateTimeImmutable
     */
    private $occuredOn;

    public function __construct(CompatriotProfileId $id, \DateTimeImmutable $occuredOn)
    {
        $this->id = $id;
        $this->occuredOn = $occuredOn;
    }

    public function getId(): CompatriotProfileId
    {
        return $this->id;
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occuredOn;
    }
}