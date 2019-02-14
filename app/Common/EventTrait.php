<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/12/19
 * Time: 10:42 PM
 */

namespace Elyurt\Common;


trait EventTrait
{
    private $events = [];
    protected function recordEvent($event): void
    {
        $this->events[] = $event;
    }
    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}