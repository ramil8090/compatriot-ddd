<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/12/19
 * Time: 11:21 PM
 */

namespace Elyurt\CompatriotProfile\Domain;


class Awards
{
    /**
     * @var CompatriotProfile
     */
    private $compatriotProfile;
    /**
     * @var Award[]
     */
    private $awards = [];

    public function __construct(array $awards=[])
    {
        if (!$awards) {
            return;
        }
        
        foreach ($awards as $award) {
            $this->add($award);
        }
    }
    public function add(Award $award): void
    {
        foreach ($this->awards as $item) {
            if ($item->isEqualTo($award)) {
                throw new \DomainException('Award already exists.');
            }
        }
        $this->awards[] = $award;
    }
    public function remove($index): Award
    {
        if (!isset($this->awards[$index])) {
            throw new \DomainException('Award is not found.');
        }
        $award = $this->awards[$index];
        unset($this->awards[$index]);
        return $award;
    }

    public function getAll(): array
    {
        return $this->awards;
    }
}