<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 16.01.19
 * Time: 17:32
 */

namespace Elyurt\CompatriotProfile\Domain\ValueObjects;


class ResidencePhones
{
    /**
     * @var Phone
     */
    private $home;
    /**
     * @var Phone
     */
    private $work;
    /**
     * @var Phone
     */
    private $mobile;

    /**
     * @param Phone $phone
     */
    public function set(Phone $phone): void
    {
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
            case Phone::WORK:
                $this->work($phone);
                break;
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

    public function work(Phone $phone): void
    {
        $this->work = $phone;
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
    public function getWork(): ?Phone
    {
        return $this->work;
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
            $this->mobile,
            $this->work
        ];
    }
}