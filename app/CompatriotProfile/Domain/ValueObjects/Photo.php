<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 14.01.19
 * Time: 17:35
 */

namespace Elyurt\CompatriotProfile\Domain\ValueObjects;


use Assert\Assertion;

class Photo
{
    /**
     * @var string
     */
    private $photo;

    public function __construct(string $photo)
    {
        Assertion::notEmpty($photo);

        $this->photo = $photo;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

}