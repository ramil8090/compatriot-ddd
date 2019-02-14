<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/13/19
 * Time: 8:31 PM
 */

namespace Elyurt\CompatriotProfile\Domain\Events;


use Elyurt\Common\DomainEvent;
use Elyurt\CompatriotProfile\Domain\CompatriotProfileId;

class CompatriotProfileAwardsChanged implements DomainEvent
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