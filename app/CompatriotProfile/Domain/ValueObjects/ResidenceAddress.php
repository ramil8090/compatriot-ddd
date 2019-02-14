<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 16.01.19
 * Time: 14:29
 */

namespace Elyurt\CompatriotProfile\Domain\ValueObjects;


use Assert\Assertion;
use PHPUnit\Framework\Constraint\Count;

class ResidenceAddress
{
    /**
     * @var CountryId
     */
    private $countryId;
    /**
     * @var string
     */
    private $state;
    /**
     * @var CityId
     */
    private $cityId;
    /**
     * @var string
     */
    private $address;

    public function __construct(CountryId $countryId, string $state, CityId $cityId, string $address)
    {
        Assertion::notEmpty($state);
        Assertion::notEmpty($address);

        $this->countryId = $countryId;
        $this->state = $state;
        $this->cityId = $cityId;
        $this->address = $address;
    }

    /**
     * @return CountryId
     */
    public function getCountryId(): CountryId
    {
        return $this->countryId;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return CityId
     */
    public function getCityId(): CityId
    {
        return $this->cityId;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

}