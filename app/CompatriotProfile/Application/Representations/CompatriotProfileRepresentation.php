<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/13/19
 * Time: 3:43 PM
 */

namespace Elyurt\CompatriotProfile\Application\Representations;

use Elyurt\CompatriotProfile\Domain\CompatriotProfile;

class CompatriotProfileRepresentation
{
    /**
     * @var CompatriotProfile
     */
    private $compatriotProfile;

    public function __construct(CompatriotProfile $compatriotProfile)
    {
        $this->compatriotProfile = $compatriotProfile;
    }

}