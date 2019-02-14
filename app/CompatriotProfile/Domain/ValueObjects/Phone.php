<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 16.01.19
 * Time: 14:44
 */

namespace Elyurt\CompatriotProfile\Domain\ValueObjects;


use Assert\Assertion;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\Self_;

class Phone
{
    /**
     * @var string
     */
    private $country;
    /**
     * @var string
     */
    private $code;
    /**
     * @var string
     */
    private $number;
    /**
     * @var int
     */
    private $type;

    const MOBILE = 1;
    const HOME = 2;
    const WORK = 3;

    public function __construct(string $country, string $code, string $number, int $type=self::WORK)
    {
        Assertion::notEmpty($country);
        Assertion::notEmpty($code);
        Assertion::notEmpty($number);
        Assertion::inArray($type, [
            self::MOBILE,
            self::HOME,
            self::WORK
        ]);


        $this->country = $country;
        $this->code = $code;
        $this->number = $number;
        $this->type = $type;
    }

    public function isEqualTo(self $phone): bool
    {
        return $this->getFull() === $phone->getFull();
    }

    public function getFull(): string
    {
        return '+' . $this->country . ' (' . $this->code . ') ' . $this->number;
    }

    public function getCountry(): int { return $this->country; }
    public function getCode(): string { return $this->code; }
    public function getNumber(): string { return $this->number; }
    public function getType(): int { return $this->type; }
}