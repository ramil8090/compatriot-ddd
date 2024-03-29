<?php

namespace Elyurt\Common;


use Assert\Assertion;


abstract class AbstractId
{
    protected $id;
    public function __construct($id = null)
    {
        Assertion::notEmpty($id);
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function isEqualTo(self $other): bool
    {
        return $this->getId() === $other->getId();
    }
}