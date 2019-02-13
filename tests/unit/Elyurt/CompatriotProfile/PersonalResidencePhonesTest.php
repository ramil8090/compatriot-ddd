<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 16.01.19
 * Time: 16:16
 */

namespace tests\Elyurt\CompatriotProfile;


use Codeception\Test\Unit;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Phone;
use tests\unit\Elyurt\CompatriotProfile\PersonalGen;

class PersonalResidencePhonesTest extends Unit
{

    public function testAddPhone()
    {
        $personal = PersonalGen::generatePersonal();
        $personal->setResidencePhone($mobile = new Phone('001', '00', '0000001', Phone::MOBILE));
        $personal->setResidencePhone($home = new Phone('001', '00', '0000002', Phone::HOME));
        $personal->setResidencePhone($work = new Phone('001', '00', '0000003', Phone::WORK));

        $this->assertEquals($mobile, $personal->getResidencePhones()->getMobile());
        $this->assertEquals($home, $personal->getResidencePhones()->getHome());
        $this->assertEquals($work, $personal->getResidencePhones()->getWork());
    }

    public function testWithSamePhoneNumbers()
    {
        $this->expectExceptionMessage('Phone already exists.');

        $personal = PersonalGen::generatePersonal();
        $personal->setResidencePhone(new Phone('001', '00', '0000001', Phone::WORK));
        $personal->setResidencePhone(new Phone('001', '00', '0000001', Phone::HOME));
        $personal->setResidencePhone(new Phone('001', '00', '0000001', Phone::MOBILE));
    }

    public function testGetNonExistPhones()
    {
        $personal = PersonalGen::generatePersonal();
        $this->assertNull($personal->getResidencePhones()->getMobile());
        $this->assertNull($personal->getResidencePhones()->getHome());
        $this->assertNull($personal->getResidencePhones()->getWork());
    }
}