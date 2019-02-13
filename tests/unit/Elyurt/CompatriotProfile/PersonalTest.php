<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 14.01.19
 * Time: 15:54
 */

namespace tests\Elyurt\CompatriotProfile;


use Codeception\Test\Unit;
use Elyurt\CompatriotProfile\Domain\Personal;
use Elyurt\CompatriotProfile\Domain\ValueObjects\BirthPlace;
use Elyurt\CompatriotProfile\Domain\ValueObjects\CityId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\CountryId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Emails;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Name;
use Elyurt\CompatriotProfile\Domain\ValueObjects\NationalityId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Phone;
use Elyurt\CompatriotProfile\Domain\ValueObjects\ResidenceAddress;
use Elyurt\CompatriotProfile\Domain\ValueObjects\UserId;

class PersonalTest extends Unit
{
    public function testCreate()
    {
        $personal = new Personal(
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

        $this->assertEquals($name, $personal->getName());
        $this->assertEquals($birthDate, $personal->getBirthDate());
        $this->assertEquals($birthPlace, $personal->getBirthPlace());
        $this->assertEquals($nationality, $personal->getNationalityId());
        $this->assertEquals($citizenship, $personal->getCitizenshipId());
        $this->assertEquals($residencePlace, $personal->getResidencePlace());
        $this->assertEquals($emails, $personal->getEmails());

        $this->assertEmpty($personal->getPhoto());
    }
}