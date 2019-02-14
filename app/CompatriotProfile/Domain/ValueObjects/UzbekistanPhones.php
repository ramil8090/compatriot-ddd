<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 16.01.19
 * Time: 17:32
 */

namespace Elyurt\CompatriotProfile\Domain\ValueObjects;


use Assert\Assertion;

class UzbekistanPhones
{
    /**
     * @var Phone
     */
    private $home;
    /**
     * @var Phone
     */
    private $mobile;

    /**
     * @param Phone $phone
     */
    public function set(Phone $phone): void
    {
        Assertion::inArray($phone->getType(), [
            Phone::MOBILE,
            Phone::HOME
        ]);

        foreach ($this->getPhones() as $item) {
            if ($item != null && $phone->isEqualTo($item)) {
                throw new \DomainException('Phone already exists.');
            }
        }

        $this->setPhoneByType($phone);
    }

    private function setPhoneByType(Phone $phone): void
    {
        switch ($phone->getType()) {
            case Phone::HOME:
                $this->home($phone);
                break;
            case Phone::MOBILE:
                $this->mobile($phone);
                break;
        }
    }

    public function home(Phone $phone): void
    {
        $this->home = $phone;
    }

    public function mobile(Phone $phone): void
    {
        $this->mobile = $phone;
    }

    /**
     * @return Phone
     */
    public function getHome(): ?Phone
    {
        return $this->home;
    }

    /**
     * @return Phone
     */
    public function getMobile(): ?Phone
    {
        return $this->mobile;
    }

    public function getPhones(): array
    {
        return [
            $this->home,
            $this->mobile
        ];
    }
}