<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/13/19
 * Time: 8:23 PM
 */

namespace Elyurt\CompatriotProfile\Application\Commands;


class ChangeAwardsCommand
{
    /**
     * @var array
     */
    public $awards;
    /**
     * @var integer
     */
    public $compatriotProfileId;

    public function __construct(array $compatriotProfileId, array $awards)
    {
        $this->compatriotProfileId = $compatriotProfileId;
        $this->awards = $awards;
    }
}