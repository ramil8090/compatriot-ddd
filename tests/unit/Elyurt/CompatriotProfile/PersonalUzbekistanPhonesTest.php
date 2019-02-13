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

class PersonalUzbekistanPhonesTest extends Unit
{

    public function testAddPhone()
    {
        $personal = PersonalGen::generatePersonal();
        $personal->setUzbekistanPhone($mobile = new Phone('001', '00', '0000001', Phone::MOBILE));
        $personal->setUzbekistanPhone($home = new Phone('001', '00', '0000002', Phone::HOME));

        $this->assertEquals($mobile, $personal->getUzbekistanPhones()->getMobile());
        $this->assertEquals($home, $personal->getUzbekistanPhones()->getHome());
    }

    public function testWithSamePhoneNumbers()
    {
        $this->expectExceptionMessage('Phone already exists.');

        $personal = PersonalGen::generatePersonal();
        $personal->setUzbekistanPhone(new Phone('001', '00', '0000001', Phone::HOME));
        $personal->setUzbekistanPhone(new Phone('001', '00', '0000001', Phone::MOBILE));
    }

    public function testGetNonExistPhones()
    {
        $personal = PersonalGen::generatePersonal();
        $this->assertNull($personal->getUzbekistanPhones()->getMobile());
        $this->assertNull($personal->getUzbekistanPhones()->getHome());
    }
}