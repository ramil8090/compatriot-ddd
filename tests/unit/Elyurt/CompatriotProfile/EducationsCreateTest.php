<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 17.01.19
 * Time: 15:44
 */

namespace tests\Elyurt\CompatriotProfile;


use Codeception\Test\Unit;

class EducationsCreateTest extends Unit
{
    public function testSuccess()
    {
        $education = new Education([
            $highEducation = new HighEducation(
                $highScoolId = new HighScoolId(1),
                $eduCountryId = new CountryId(1),
                $beginDate = new \DateTimeImmutable(),
                $endDate = new \DateTimeImmutable(),
                $specialityId = new SpecialityId(1),
                $diploma = new Diploma(
                    $number = "AA123456",
                    $degree = Diploma::BACHELOR
                )
            ),
        ]);
    }
}