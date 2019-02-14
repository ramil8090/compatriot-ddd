<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 16.01.19
 * Time: 14:40
 */

namespace Elyurt\CompatriotProfile\Domain\ValueObjects;


class Emails
{
    /**
     * @var array
     */
    private $emails;

    public function __construct(array $emails)
    {
        $this->emails = $emails;
    }

    public function getAll(): array
    {
        return $this->emails;
    }
}