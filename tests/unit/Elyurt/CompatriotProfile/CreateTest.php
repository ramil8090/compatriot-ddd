<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 14.01.19
 * Time: 15:16
 */

namespace tests\Elyurt\CompatriotProfile;


use Codeception\Test\Unit;
use Elyurt\CompatriotProfile\Domain\Awards;
use Elyurt\CompatriotProfile\Domain\CompatriotProfile;
use Elyurt\CompatriotProfile\Domain\CompatriotProfileId;
use Elyurt\CompatriotProfile\Domain\Personal;
use tests\unit\Elyurt\CompatriotProfile\PersonalGen;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $personal = PersonalGen::generatePersonal();
        $compatriotProfile = new CompatriotProfile(
            new CompatriotProfileId(1),
            $personal,
            $awards = new Awards()
        );
    }
}