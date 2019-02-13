<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 16.01.19
 * Time: 16:04
 */

namespace tests\unit\Elyurt\CompatriotProfile;


use Elyurt\CompatriotProfile\Domain\Personal;
use Elyurt\CompatriotProfile\Domain\ValueObjects\BirthPlace;
use Elyurt\CompatriotProfile\Domain\ValueObjects\CityId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\CountryId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Emails;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Name;
use Elyurt\CompatriotProfile\Domain\ValueObjects\NationalityId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\ResidenceAddress;
use Elyurt\CompatriotProfile\Domain\ValueObjects\UserId;

class PersonalGen
{
    public static function generatePersonal(): Personal
    {
        return new Personal(
            $userId = new UserId(1),
            $name = new Name("Askar", "Askarov", "Askar o'g'li", Name::RUSSIAN_LANGUAGE),
            $birthDate = new \DateTimeImmutable(),
            $birthPlace = new CityId(1),
            $nationality = new NationalityId(1),
            $citizenship = new CountryId(2),
            $residencePlace = new ResidenceAddress(
                new CountryId(2),
                "Washington State",
                new CityId(1),
                "Washignton, Orange st., house 5b"
            ),
            $emails = new Emails([
                "first@email.com",
                "second@email.com"
            ])
        );
    }
}